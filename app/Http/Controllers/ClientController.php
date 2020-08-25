<?php

namespace App\Http\Controllers;

use App\Quest;
use Illuminate\Http\Request;

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
}
