<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.userform');
    }

    public function user(){
        $users = DB::table('users')
            ->select('users.*')
            ->where('user_type','=','student')
            ->orderByDesc('exp')
            ->get();

        return view('users.user', compact(['users']));
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

    public function detailuser($user){
        $user = DB::table('users')
            ->select('users.*')
            ->where('name','=',$user)
            ->first();

        $exp = DB::table('posts')
            ->select('posts.exp')
            ->where('id_user','=',$user->id)
            ->where('ongoing','=','0')
            ->sum('exp');

        $subject = DB::table('posts')
            ->select('subjects.subject_name')
            ->join('subjects','posts.id_subject','subjects.id')
            ->where('posts.id_user','=',$user->id)
            ->get();

        $subjects = $subject->unique();

        /*$subject = DB::table('posts')
            ->select('subjects.subject_name')
            ->join('subjects','posts.id_subject','subjects.id')
            ->where('posts.id_user','=',Auth::user()->id)
            ->get();

        $subjects = $subject->unique();*/


        return view('users.userdetail', compact(['user', 'exp', 'subjects']));
    }
}
