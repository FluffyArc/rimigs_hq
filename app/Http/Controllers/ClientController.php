<?php

namespace App\Http\Controllers;

use App\Acquire;
use App\Aqcuire;
use App\Lecture;
use App\Post;
use App\Quest;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Image;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ClientController extends Controller
{


    public function login()
    {
        return view('client.clientlogin');
    }

    public function home()
    {
        return view('client.clienthome');
    }

    public function register()
    {
        return view('client.clientregister');
    }

    public function changeProfile($id)
    {
        $user = User::findOrFail($id);
        return view('client.clientchangeprofile', compact(['user']));
    }

    public function updateProfile(Request $request)
    {
        $filename = "";
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('upload/avatar/' . $filename));

            $user = DB::table('users')
                ->where('id', '=', Auth::user()->id)
                ->update(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'username' => $request->username,
                        'avatar' => $filename
                    ]
                );
            //$user->save();
        } else {
            $user = DB::table('users')
                ->where('id', '=', Auth::user()->id)
                ->update(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'username' => $request->username,
                    ]
                );
        }

        return redirect()->route('profile');

    }

    public function quest($level, $subject)
    {
        $key = str_replace('%20', ' ', $subject);
        $subject = DB::table('subjects')
            ->select('subjects.*')
            ->where('subject_name', '=', $key)
            ->first();

        $levels = DB::table('quests')
            ->select('quests.*')
            ->where('level', '=', $level)
            ->where('id_subject', '=', $subject->id)
            ->where('status','=','1')
            ->get();

        $count = DB::table('quests')
            ->select('quests.*')
            ->where('level', '=', $level)
            ->count();

        return view('client.questlist', compact(['levels', 'count']));


    }

    public function questDetail(Request $request)
    {
        $details = Quest::findOrFail($request->id);

        $posts = DB::table('posts')
            ->select('posts.*')
            ->where('id_quest', '=', $request->id)
            ->where('ongoing', '=', '1')
            ->get();

        $available = $details->max_player - $posts->count();

        return response()->json(array(
            'details' => $details,
            'available' => $available
        ));
        //return response()->json($details);
    }

    public function questLevel($subject)
    {

        /*$user = Auth::user()->id;
        $level = User::findOrFail($user);*/
        $key = str_replace('%20', ' ', $subject);
        $subjects = DB::table('subjects')
            ->select('subjects.*')
            ->where('subject_name', '=', $key)
            ->first();

        /*$level = DB::table('grades')
            ->select('grades.*')
            ->where('id_user', '=', Auth::user()->id)
            ->where('id_subject', '=', $subjects->id)
            ->sum('hr');*/

        $level = DB::table('grades')
            ->select('*')
            ->where('id_user', '=', Auth::user()->id)
            ->count();

        $lectures = DB::table('lectures')
            ->select('*')
            ->where('id_subject','=', $subjects->id)
            ->get();


        return view('client.clientquestlevel', compact(['level', 'subject','lectures']));
    }

    public function questPost(Request $request)
    {
        $post = new Post();
        /*$post->id_user = DB::table('users')
            ->where('name', '=', $request->input('studentName'))
            ->value('id');*/
        $post->id_user = $request->id_user;
        $post->id_quest = $request->id_quest;
        $post->id_subject = $request->id_subject;

        $date = Carbon::now()->addDay($request->exp_date)->format('Y-m-d');
        $post->ongoing = "1";
        $quest = Quest::findOrFail($request->id_quest);

        $checkQuestMax = DB::table('posts')
            ->select('posts.*')
            ->where('id_quest', '=', $request->id_quest)
            ->where('ongoing', '=', '1')
            ->get();

        $check = DB::table('posts')
            ->select('posts.*')
            ->where('id_user', '=', $request->id_user)
            ->where('ongoing', '=', '1')
            ->get();

        $checkpostquest = DB::table('posts')
            ->select('posts.*')
            ->where('id_user', '=', $request->id_user)
            ->where('id_quest', '=', $request->id_quest)
            ->where('ongoing', '=', '1')
            ->get();

        $checkCompletedQuest = DB::table('posts')
            ->select('posts.*')
            ->where('id_user', '=', $request->id_user)
            ->where('id_quest', '=', $request->id_quest)
            ->where('ongoing', '=', '0')
            ->get();

        if($checkpostquest->count() >= 1){
            return response()->json(['failed' => 'Sorry, You already pick this quest. Try another one']);
        }
        else if ($check->count() == 3) {
            return response()->json(['failed' => 'Sorry, You reach your maximum quests. Ty to finish those first']);
        } else if ($checkCompletedQuest->count() >= 1) {
            return response()->json(['failed' => 'You already complete this quest']);
        } else {
            if ($checkQuestMax->count() >= $quest->max_player)
                return response()->json(['failed' => 'Sorry, this quest already reach its maximum player']);
            else {
                $post->save();
                return response()->json(['success' => 'Quest Posted']);
            }
            //return response()->json(['success'=>$check->count()]);
        }

    }

    public function questTaken()
    {
        $quests = DB::table('posts')
            ->select('posts.*', 'quests.*')
            ->join('quests', 'quests.id', 'posts.id_quest')
            ->where('posts.id_user', '=', Auth::user()->id)
            ->orderBy('posts.id', 'desc')
            ->get();

        return view('client.clientquesttaken', compact(['quests']));
    }

    public function detail($idQuest)
    {
        $quests = Quest::findOrFail($idQuest);
        $posts = DB::table('posts')
            ->select('posts.*')
            ->where('id_user', '=', Auth::user()->id)
            ->where('id_quest', '=', $idQuest)
            ->orderByDesc('id')
            ->first();

        return view('client.clientquestdetail', compact(['quests', 'posts']));
    }

    public function abortQuest(Request $request)
    {
        $quests = DB::table('posts')
            ->select('posts.*')
            ->where('id_user', '=', Auth::user()->id)
            ->where('id_quest', '=', $request->idQuest)
            ->orderByDesc('id')
            ->first();


        $abort = Post::findOrFail($quests->id);
        $abort->ongoing = '2';

        $abort->save();
        return response()->json(['success' => 'Quest Aborted! No Worries, you can take another quest']);
    }

    public function profile()
    {
        $subject = DB::table('posts')
            ->select('subjects.subject_name')
            ->join('subjects', 'posts.id_subject', 'subjects.id')
            ->where('posts.id_user', '=', Auth::user()->id)
            ->get();

        $subjects = $subject->unique();

        $hr = DB::table('grades')
            ->select('hr')
            ->where('id_user', '=', Auth::user()->id)
            ->sum('hr');

        $completedQuests = DB::table('grades')
            ->select('*')
            ->where('id_user', '=', Auth::user()->id)
            ->count();

        //Achievements condition
        $achs = DB::table('acquires')
            ->select('ach_title', 'ach_icon', 'hr_reward')
            ->join('achievements', 'acquires.id_ach', '=', 'achievements.id')
            ->where('acquires.id_user', '=', Auth::user()->id)
            ->get();


        return view('client.clientprofile', compact(['subjects', 'achs', 'completedQuests', 'hr']));
    }

    public function receivedAch(Request $request)
    {
        $check = DB::table('acquires')
            ->select('*')
            ->where('id_user', '=', Auth::user()->id)
            ->where('id_ach', '=', $request->id_ach)
            ->count();

        if ($check > 0) {
            return response()->json(['failed' => 'You Already Received The Achievement']);
        } else {
            $acquires = new Acquire();
            $acquires->id_user = Auth::user()->id;
            $acquires->id_ach = $request->id_ach;
            $acquires->received = 1;

            $acquires->save();
            return response()->json(['success' => 'Achievement Acquire']);
        }
    }

    public function subjects()
    {
        $subjects = Subject::all();

        return view('client.clientchoosesubject', compact(['subjects']));
    }

    public function changepass()
    {
        return view('client.clientchangepassword');
    }

    public function updatepass(Request $request)
    {
        $user = DB::table('users')
            ->select('*')
            ->where('email', '=', $request->email)
            ->first();

        $user->password = $request->newpass;


        if ($request->newpass == $request->confirmpass) {
            $update = DB::table('users')
                ->where('email', '=', $request->email)
                ->update(
                    [
                        'password'=>$user->password
                    ]
                );
            return response()->json(['success' => 'Password Change Successfully']);
        } else {
            return response()->json(['failed' => 'Password changed failed. Make sure you type the correct password']);
        }


    }

    public function lecture($id){
        $lecture = Lecture::findOrFail($id);

        return view('client.clientlecture',compact(['lecture']));
    }
}
