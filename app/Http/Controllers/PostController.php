<?php

namespace App\Http\Controllers;

use App\Post;
use App\Quest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        //$posts = Post::all();
        $posts = DB::table('posts')
            ->select('users.name', 'quests.title', 'posts.exp_date','posts.complete_date', 'posts.ongoing')
            ->join('users','users.id','=','posts.id_user')
            ->join('quests','quests.id','=','posts.id_quest')
            ->get();
        return view('posts.post', compact(['posts']));
    }

    public function form()
    {
        return view('posts.postform');
    }

    public function studentsAndQuestsById($id)
    {
        $students = User::all();
        $quest = Quest::findOrFail($id);

        //$days = DB::select(DB::raw("Select days_required from quests where id = '$id'"))->first();
        $days = Quest::where('id',$id)->first();

        $date = Carbon::now()->addDay($days->days_required)->format('d-m-Y');

        return view('posts.postform', compact(['students', 'quest', 'date']));
    }

    public function postQuest(Request $request)
    {
        $post = new Post();
        /*$post->id_user = DB::table('users')
            ->where('name', '=', $request->input('studentName'))
            ->value('id');*/
        $post->id_user = $request->studentName;
        $post->id_quest = DB::table('quests')
        ->where('title','=', $request->questDesc)
        ->value('id');
        $post->exp_date = $request->expiredDate;
        $post->complete_date = $request->completeDate;
        $post->ongoing = "1";
        $post->save();

        return redirect('posts')->with('mssg', 'Post Added Successfully');
    }


}
