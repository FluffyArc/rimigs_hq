<?php

namespace App\Http\Controllers;

use App\Acquire;
use App\Grade;
use App\Post;
use App\Quest;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        //$posts = Post::all();
        $posts = DB::table('posts')
            ->select('users.name', 'quests.title', 'subjects.subject_name', 'posts.id', 'posts.ongoing')
            ->join('users','users.id','=','posts.id_user')
            ->join('quests','quests.id','=','posts.id_quest')
            ->join('subjects','subjects.id','=','posts.id_subject')
            ->where('posts.ongoing','=','1')
            ->get();

        $subjects = DB::table('subjects')
            ->select('subject_name')
            ->get();

        return view('posts.post', compact(['posts', 'subjects']));
    }

    public function selectSubjectInPost(Request $request){
        $subject = DB::table('posts')
            ->select('posts.id', 'users.name', 'quests.title', 'posts.ongoing','posts.id_user')
            ->join('users','users.id','=','posts.id_user')
            ->join('subjects','subjects.id','=','posts.id_subject')
            ->join('quests','quests.id','=','posts.id_quest')
            ->where('subjects.subject_name','=',$request->subjectName)
            ->where('posts.ongoing','=','1')
            ->get();



        return response()->json(array(
            'subjects' => $subject,

        ));
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
                'posts.id', 'posts.ongoing','subjects.subject_name')
            ->join('users','users.id','=','posts.id_user')
            ->join('quests','quests.id','=','posts.id_quest')
            ->join('subjects','subjects.id','=','posts.id_subject')
            ->where('posts.id','=',$id)
            ->first();



        return view('posts.postgrade', compact(['post']));
    }

    public function grade(Request $request){
        $this->validate($request,[
            'grade' => 'required'
        ]);

        $post = Post::findOrFail($request->id);
        //$post->exp = $request->grade;
        //$post->complete_date = date('Y-m-d',strtotime($request->completeDate));
        $post->ongoing = $request->status;


        /*$user = DB::table('users')
            ->select('users.*')
            ->where('id','=',$post->id_user)
            ->first();
        $users = User::findOrFail($user->id);*/
        //$users->exp += $request->grade;

        $grade = new Grade();
        $grade->id_user = $post->id_user;
        $grade->id_subject = $post->id_subject;
        $grade->hr = $request->grade;
        $grade->id_post = $post->id;
        $grade->id_quest = $post->id_quest;

        if($request->grade > $request->maxgrade){
            return response()->json(['failed'=>'Sorry, your grade is to high for this quest']);
        }else{
            $post->save();
            $grade->save();

            $ach_check = DB::table('grades')
                ->select('*')
                ->where('id_user','=',$post->id_user)
                ->count();

            if($ach_check == 5)
                $this->insertAch($post->id_user, 1);
            else if($ach_check == 8)
                $this->insertAch($post->id_user, 2);
            else if($ach_check == 10)
                $this->insertAch($post->id_user, 3);
            else if($ach_check == 12)
                $this->insertAch($post->id_user, 4);

            $ach_check_perfect_score = DB::table('quests')
                ->select('quests.*','grades.*')
                ->join('grades','grades.id_quest','=','quests.id')
                ->where('grades.id_user','=',$post->id_user)
                ->whereRAW('grades.hr = quests.exp')
                ->count();

            if($ach_check_perfect_score == 5)
                $this->insertAch($post->id_user, 5);
            else if($ach_check_perfect_score == 7)
                $this->insertAch($post->id_user, 6);
            else if($ach_check_perfect_score == 10)
                $this->insertAch($post->id_user, 7);

            return response()->json(['success'=>'Post graded successfully']);
        }


    }

    public function insertAch($id_user, $id_ach){
        $acquires = new Acquire();

        $acquires->id_user = $id_user;
        $acquires->id_ach = $id_ach;

        $acquires->save();
    }


}
