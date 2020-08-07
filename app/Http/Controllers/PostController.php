<?php

namespace App\Http\Controllers;

use App\Post;
use App\Quest;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('posts.post', compact('posts'));
    }

    public function form(){
        return view('posts.postform');
    }

    public function studentsAndQuestsById($id){
        $students = User::all();
        $quest = Quest::findOrFail($id);

        return view('posts.postform', compact(['students','quest']));
    }


}
