<?php

namespace App\Http\Controllers;

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

        return response()->json($details->desc);
    }



    public function questLevel(){
        $user = Auth::user()->id;
        $level = User::findOrFail($user);

        return view('client.clientquestlevel', compact(['level']));
    }

}
