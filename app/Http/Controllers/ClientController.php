<?php

namespace App\Http\Controllers;

use App\Post;
use App\Quest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class ClientController extends Controller
{
    public function quests(){
        $quests = Quest::all();
    }

    public function login(){
        return view('client.clientlogin');
    }

    public function home(){
        return view('client.clienthome');
    }

    public function register(){
        return view('client.clientregister');
    }

    public function quest($level){

            $levels = DB::table('quests')
                ->select('quests.*')
                ->where('level','=',$level)
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





    public function questLevel(){
        $user = Auth::user()->id;
        $level = User::findOrFail($user);

        return view('client.clientquestlevel', compact(['level']));
    }

    public function questPost(Request $request){
        $post = new Post();
        /*$post->id_user = DB::table('users')
            ->where('name', '=', $request->input('studentName'))
            ->value('id');*/
        $post->id_user = $request->id_user;
        $post->id_quest = $request->id_quest;
        $post->exp_date = $request->exp_date;

        $post->ongoing = "1";
        $post->status = "ongoing";
        $post->exp = $request->exp;
        $post->save();

        return response()->json(['success'=>'Quest Posted']);
    }
}
