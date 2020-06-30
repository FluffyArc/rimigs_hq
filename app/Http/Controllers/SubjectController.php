<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();

        return view('subjects.subject', compact('subjects'));
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

        $subject->save();

        return redirect('/subjects')->with('mssg', 'Subject Added Successfully');
    }

}
