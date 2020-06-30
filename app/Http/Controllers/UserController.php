<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllStudent($id){
        $students = User::findOrFail($id);

        return view('posts.postform', compact('students'));
    }
}
