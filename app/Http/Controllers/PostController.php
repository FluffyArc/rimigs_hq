<?php

namespace App\Http\Controllers;

use App\Post;
use App\Quest;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        //$posts = Post::all();
        $posts = DB::table('posts')
            ->select('users.name', 'quests.title', 'subjects.subject_name', 'posts.id', 'posts.exp_date','posts.complete_date', 'posts.ongoing')
            ->join('users','users.id','=','posts.id_user')
            ->join('quests','quests.id','=','posts.id_quest')
            ->join('subjects','subjects.id','=','posts.id_subject')
            ->get();



        return view('posts.post', compact(['posts']));
    }

    public function form()
    {
        return view('posts.postform');
    }

    public function studentsAndQuestsById($id, $subject)
    {
        $students = User::all();
        $quest = Quest::findOrFail($id);
        $subject = Subject::findOrFail($subject);

        $posts = DB::table('posts')
            ->select('posts.*')
            ->where('id_quest','=',$id)
            ->where('ongoing','=','1')
            ->get();

        $available = $quest->max_player - $posts->count();

        //$days = DB::select(DB::raw("Select days_required from quests where id = '$id'"))->first();
        $days = Quest::where('id',$id)->first();

        $date = Carbon::now()->addDay($days->days_required)->format('d-m-Y');

        return view('posts.postform', compact(['students', 'quest', 'date', 'subject', 'available']));
    }

    public function postQuest(Request $request)
    {
        $subjectid = DB::table('subjects')
            ->select('subjects.id')
            ->where('subjects.subject_name','=',$request->subjectname)
            ->first();

        $questid = DB::table('quests')
            ->select('quests.*')
            ->where('title','=', $request->questDesc)
            ->first();

        $post = new Post();
        /*$post->id_user = DB::table('users')
            ->where('name', '=', $request->input('studentName'))
            ->value('id');*/
        $post->id_user = $request->studentName;
        $post->id_quest = $questid->id;
        $post->id_subject = $subjectid->id;

        $date = Carbon::now()->addDay($request->expiredDate)->format('Y-m-d');
        $post->exp_date = $date;
        $post->complete_date = $request->completeDate;
        $post->ongoing = "1";
        $post->exp = $questid->exp;

        $checkQuestMax = DB::table('posts')
            ->select('posts.*')
            ->where('id_quest','=',$questid->id)
            ->where('ongoing','=','1')
            ->get();

        $check = DB::table('posts')
            ->select('posts.*')
            ->where('id_user','=',$request->studentName)
            ->where('ongoing','=','1')
            ->get();

        $checkCompletedQuest = DB::table('posts')
            ->select('posts.*')
            ->where('id_user','=',$request->studentName)
            ->where('id_quest','=',$questid->id)
            ->where('ongoing','=','0')
            ->get();

        if($check->count() == 1){
            return redirect('posts')->with('error', 'You are still in ongoing quest');

        }else if($checkCompletedQuest->count() >= 1){
            return redirect('posts')->with('error', 'You have already complete this quest');

        }
        else{
            if($checkQuestMax->count() >= $questid->max_player)
                return redirect('posts')->with('error', 'This quest already reached its maximum player');
            else {
                $post->save();
                return redirect('posts')->with('success', 'Post Added Successfully');
            }
            //return response()->json(['success'=>$check->count()]);
        }
    }

    public function postgrade($id){
        $post = DB::table('posts')
            ->select('users.name', 'quests.title', 'quests.desc', 'quests.exp', 'subjects.subject_name',
                'posts.id', 'posts.exp_date','posts.complete_date', 'posts.ongoing','subjects.subject_name')
            ->join('users','users.id','=','posts.id_user')
            ->join('quests','quests.id','=','posts.id_quest')
            ->join('subjects','subjects.id','=','posts.id_subject')
            ->where('posts.id','=',$id)
            ->first();


        $date = Carbon::now()->format('d-M-Y');
        return view('posts.postgrade', compact(['date','post']));
    }

    public function grade(Request $request){
        $this->validate($request,[
            'grade' => 'required'
        ]);
        $post = Post::findOrFail($request->id);
        $post->exp = $request->grade;
        $post->complete_date = date('Y-m-d',strtotime($request->completeDate));
        $post->ongoing = $request->status;


        $user = DB::table('users')
            ->select('users.*')
            ->where('name','=',$request->name)
            ->first();
        $users = User::findOrFail($user->id);
        $users->exp += $request->grade;

        if($request->grade > $request->maxgrade){
            return response()->json(['failed'=>'Sorry, your grade is to high for this quest']);
        }else{
            $post->save();
            $users->save();
            return response()->json(['success'=>'Post graded successfully']);
        }


    }


}
