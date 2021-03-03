<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        $no = 1;

        return view('subjects.subject', compact('subjects','no'));
    }

    public function form()
    {
        return view('subjects.subjectform');
    }

    public function addSubject()
    {
        $subject = new Subject();

        $subject->subject_name = request('subjectName');
        $subject->credit = request('credit');
        $subject->active = \request('status');

        $subject->save();

        return redirect('adminSubjects')->with('success', 'Subject Added Successfully');
    }

    public function getSubjectName(){
        $subjects = Subject::all();
        return view('quests.questform', compact('subjects'));
    }

    public function subjectList(){
        $subjects = Subject::all();

        return view('subjects.subjectList', compact('subjects'));
    }

    public function edit($id){
        $subject = Subject::findOrFail($id);

        return view('subjects.subjectedit',compact(['subject']));
    }
    public function update(Request $request, $id){
        $subject = DB::table('subjects')
            ->where('id', '=', $id)
            ->update(
                [
                    'subject_name' => $request->subjectName,
                    'credit' => $request->credit,
                    'active' => $request->status,
                ]
            );
        return redirect()->route('adminSubjects')->with('success','Subject Updated Successfully');
    }

    public function destroy($id){
        $lecture = Subject::findOrFail($id);

        $lecture->delete();
        return redirect()->route('adminSubjects')->with('success','Subject Deleted Successfully');
    }
}
