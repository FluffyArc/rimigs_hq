<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function students(){
       $students = User::all();
       return view('posts.postform', compact('students'));
   }
}
