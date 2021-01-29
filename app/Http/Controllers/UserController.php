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
        //user form di menu Add Player
        return view('users.userform');
    }

    public function user(){
        $users = DB::table('users')
            ->select('users.*')
            ->where('user_type','=','student')
            ->get();

        $subjects = DB::table('subjects')
            ->select('subject_name')
            ->get();

        return view('users.user', compact(['users', 'subjects']));
    }

    public function selectSubject(Request $request){
        $subject = DB::table('grades')
            ->select('users.name', 'grades.hr')
            ->join('users','users.id','=','grades.id_user')
            ->join('subjects','subjects.id','=','grades.id_subject')
            ->where('subjects.subject_name','=',$request->subjectName)
            ->get();

        return response()->json(array(
            'subjects' => $subject,

        ));
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
            ->where('posts.ongoing','=','0')
            ->orderBy('posts.id','asc')
            ->get();

        $subjects = $subject->unique();

        /*$subject = DB::table('posts')
            ->select('subjects.subject_name')
            ->join('subjects','posts.id_subject','subjects.id')
            ->where('posts.id_user','=',Auth::user()->id)
            ->get();

        $subjects = $subject->unique();*/

        $completedQuests = DB::table('posts')
            ->select('posts.id_quest', 'posts.exp', 'quests.title', 'quests.exp as questExp')
            ->join('quests','posts.id_quest','=','quests.id')
            ->where('posts.id_user','=',$user->id)
            ->where('posts.ongoing','=','0')
            ->orderBy('posts.id','asc')
            ->get();


        $completed = $completedQuests->unique();


        return view('users.userdetail', compact(['user', 'exp', 'subjects', 'completed']));
    }


}
