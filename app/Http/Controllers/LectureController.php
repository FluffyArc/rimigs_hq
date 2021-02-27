<?php

namespace App\Http\Controllers;

use App\Lecture;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LectureController extends Controller
{
    public function index(){
        $lectures = DB::table('lectures')
            ->select('lectures.*','subjects.subject_name')
            ->join('subjects','subjects.id','=','lectures.id_subject')
            ->get();

        $no = 1;

        return view('lectures.lecture', compact(['lectures', 'no']));
    }

    public function form(){
        $subjects = Subject::all();
        return view('lectures.lectureform', compact(['subjects']));
    }

    public function add(Request $request){
        $lectures = new Lecture();

        $lectures->title = $request->title;
        $lectures->desc = $request->desc;
        $lectures->id_subject = $request->subject;

        $lectures->save();

        return redirect()->route('lectures')->with('success','Lecture Added Successfully');
    }

    public function edit($id){
        $lecture = DB::table('lectures')
            ->select('lectures.*','subjects.subject_name')
            ->join('subjects','subjects.id','=','lectures.id_subject')
            ->where('lectures.id','=',$id)
            ->first();

        $subjects = Subject::all();
        return view('lectures.editlecture', compact(['subjects', 'lecture']));
    }

    public function update(Request $request, $id){
        $update = DB::table('lectures')
            ->where('id', '=', $id)
            ->update(
                [
                    'title'=>$request->title,
                    'desc'=>$request->desc,
                    'id_subject'=>$request->subject
                ]
            );

        return redirect()->route('lectures')->with('success','Lecture Updated Successfully');
    }

    public function destroy($id){
        $lecture = Lecture::findOrFail($id);

        $lecture->delete();
        return redirect()->route('lectures')->with('success','Lecture Deleted Successfully');
    }
}
