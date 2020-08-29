<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.userform');
    }

    public function user(){
        return view('users.user');
    }

    public function students()
    {
        $students = User::all();
        return view('posts.postform', compact('students'));
    }

    public function addStudent(){
        $users = new User();
        $users->name = \request('studentName');
        $users->email = \request('studentEmail');
        $users->user_type = "student";
        $users->password = Hash::make(\request('password'));

        if(\request('password') != \request('confirmPassword'))
            return redirect('/userForm')->with('error','Password did not match');
        else{
            $users->save();
            return redirect('/userForm')->with('success', 'Student added successfully');
        }

    }
}
