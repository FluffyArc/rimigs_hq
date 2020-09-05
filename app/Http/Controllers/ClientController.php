<?php

namespace App\Http\Controllers;

use App\Post;
use App\Quest;
use App\Subject;
use App\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class ClientController extends Controller
{


    public function login(){
        return view('client.clientlogin');
    }

    public function home(){
        return view('client.clienthome');
    }

    public function register(){
        return view('client.clientregister');
    }

    public function quest($level, $subject){
            $key = str_replace('%20',' ',$subject);
            $subject = DB::table('subjects')
                ->select('subjects.*')
                ->where('subject_name','=',$key)
                ->first();

            $levels = DB::table('quests')
                ->select('quests.*')
                ->where('level','=',$level)
                ->where('id_subject','=',$subject->id)
                ->get();

            $count = DB::table('quests')
                ->select('quests.*')
                ->where('level','=',$level)
                ->count();

        return view('client.questlist', compact(['levels', 'count']));


    }

    public function questDetail(Request $request){
        $details = Quest::findOrFail($request->id);

        return response()->json($details);
    }

    public function questLevel($subject){

        $user = Auth::user()->id;
        $level = User::findOrFail($user);

        return view('client.clientquestlevel', compact(['level', 'subject']));
    }

    public function questPost(Request $request){
        $post = new Post();
        /*$post->id_user = DB::table('users')
            ->where('name', '=', $request->input('studentName'))
            ->value('id');*/
        $post->id_user = $request->id_user;
        $post->id_quest = $request->id_quest;
        $post->id_subject = $request->id_subject;

        $date = Carbon::now()->addDay($request->exp_date)->format('Y-m-d');

        $post->exp_date = $date;

        $post->ongoing = "1";
        $post->exp = $request->exp;

        $check = DB::table('posts')
            ->select('posts.*')
            ->where('id_user','=',$request->id_user)
            ->where('ongoing','=','1')
            ->get();

        $checkCompletedQuest = DB::table('posts')
            ->select('posts.*')
            ->where('id_user','=',$request->id_user)
            ->where('id_quest','=',$request->id_quest)
            ->where('ongoing','=','0')
            ->get();

        if($check->count() == 1){
            return response()->json(['success'=>'Sorry, You are still in ongoing quest']);
        }else if($checkCompletedQuest->count() >= 1){
            return response()->json(['success'=>'You already complete this quest']);
        }
        else{
            $post->save();
            return response()->json(['success'=>'Quest Posted']);
            //return response()->json(['success'=>$check->count()]);
        }

    }

    public function questTaken(){
        $quests = DB::table('posts')
            ->select('posts.*', 'quests.*')
            ->join('quests','quests.id','posts.id_quest')
            ->where('posts.id_user','=',Auth::user()->id)
            ->get();

        return view('client.clientquesttaken', compact(['quests']));
    }

    public function detail($idQuest){
        $quests = Quest::findOrFail($idQuest);

        return view('client.clientquestdetail', compact(['quests']));
    }

    public function abortQuest(Request $request){
        $quests = DB::table('posts')
            ->select('posts.*')
            ->where('id_user','=',Auth::user()->id)
            ->where('id_quest','=',$request->idQuest)
            ->first();


        $abort = Post::findOrFail($quests->id);
        $abort->ongoing = '2';

        $abort->save();
        return response()->json(['success'=>'Quest Aborted']);
    }

    public function profile(){
        $subjects = DB::table('posts')
            ->select('posts.*', 'subjects.subject_name')
            ->join('subjects','posts.id_subject','subjects.id')
            ->where('id_user','=',Auth::user()->id)
            ->get();

        return view('client.clientprofile', compact(['subjects']));
    }

    public function subjects(){
        $subjects = Subject::all();

        return view('client.clientchoosesubject', compact(['subjects']));
    }
}
