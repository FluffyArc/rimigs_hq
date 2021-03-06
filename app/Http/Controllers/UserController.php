<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        //user form di menu Add Player
        return view('users.userform');
    }

    public function user(Request $request){


        $nomor = 1;
        if($request->ajax()){
            $users = DB::table('users')
                ->select('users.*')
                ->where('user_type','=','student')
                ->orderBy('name','asc')
                ->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="detailuser/'.$row->id.'" class="edit btn btn-primary btn-sm">View</a>';
                    $del ='<a href="destroyUser/'.$row->id.'" class="edit btn btn-danger btn-sm">Delete</a>';
                    return $btn." ".$del;
                })
                ->rawColumns(['action'])

                ->make(true);
        }
        return view('users.user');

    }


    public function selectSubject(Request $request){
        /*$subject = DB::table('grades')
            ->select('users.name')
            ->join('users','users.id','=','grades.id_user')
            ->join('subjects','subjects.id','=','grades.id_subject')
            ->where('subjects.subject_name','=',$request->subjectName)
            ->groupBy('users.name')
            ->get();*/

        $subject = DB::table('grades')
            ->selectRaw('users.name, sum(grades.hr) as hr')
            ->join('users','users.id','=','grades.id_user')
            ->join('subjects','subjects.id','=','grades.id_subject')
            ->where('subjects.subject_name','=',$request->subjectName)
            ->groupBy('users.name')
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
        $users->username = \request('username');
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
            ->where('id','=',$user)
            ->first();

        $exp = DB::table('grades')
            ->select('grades.hr')
            ->where('id_user','=',$user->id)
            ->sum('hr');

        $subject = DB::table('posts')
            ->select('subjects.subject_name')
            ->join('subjects','posts.id_subject','=', 'subjects.id')
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

        /*$completedQuests = DB::table('posts')
            ->select('posts.id_quest', 'grades.hr', 'quests.title', 'quests.exp as questExp')
            ->join('quests','posts.id_quest','=','quests.id')
            ->join('grades','posts.id','=','grades.id_post')
            ->where('posts.id_user','=',$user->id)
            ->where('posts.ongoing','=','0')
            ->orderBy('posts.id','asc')
            ->get();*/

        $completedQuests = DB::table('grades')
            ->select('quests.title', 'quests.exp','grades.hr')
            ->join('quests','quests.id','=','grades.id_quest')
            ->where('grades.id_user','=',$user->id)
            ->orderBy('grades.id','asc')
            ->get();

        $completed = $completedQuests->unique();

        $achievements = DB::table('acquires')
            ->select('achievements.ach_title','achievements.hr_reward')
            ->join('achievements','achievements.id','=','acquires.id_ach')
            ->where('id_user','=',$user->id)
            ->get();


        return view('users.userdetail', compact(['user', 'exp', 'subjects', 'completed', 'achievements']));
    }

    public function destroyUser($id){

        $users = User::findOrFail($id);
        $users->delete();

        return redirect('users')->with('success','User Deleted Successfully');
        /*$quests = Quest::findOrFail($id);
        $subjectName = Subject::findOrFail($quests->id_subject);
        $quests->delete();
        return redirect()->route('showQuest',$subjectName->subject_name)->with('success','Quest Deleted Successfully');*/
    }

}
