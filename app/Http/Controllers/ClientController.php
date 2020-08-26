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

        return view('client.questlist', compact(['levels']));
    }

    public function questLevel(){
        $user = Auth::user()->id;
        $level = User::findOrFail($user);

        return view('client.clientquestlevel', compact(['level']));
    }

}
