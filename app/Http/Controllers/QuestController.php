<?php

namespace App\Http\Controllers;

use App\Quest;
use App\Subject;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function form(){
        return view ('quests.questform');
    }

    public function addQuest(){
        $quest = new Quest();

        $quest->title = request('questTitle');
        $quest->desc = request('questDesc');
        $quest->exp = request('exp');
        $quest->level = request('level');
        $quest->max_player = request('maxPlayer');
        $quest->days_required = request('daysRequired');
        $quest->id_subject = request('subject');

        $quest->save();

        return redirect('showQuest')->with('success','Quest Added Successfully');
    }

    public function showQuest(){
        $quests = Quest::all();
        return view('quests.showquest', compact('quests'));
    }

    public function editQuest($id){
        $quests = Quest::findOrFail($id);
        $subjects = Subject::all();
        return view('quests.editquest', compact(['quests', 'subjects']));
    }

    public function updateQuest(Request $request, $id){
        $this->validate($request,[
            'questTitle' => 'required',
            'questDesc' => 'required',
            'exp' => 'required',
            'level' => 'required',
            'maxPlayer' => 'required',
            'daysRequired' => 'required',
            'subject' => 'required'
        ]);

        $quests = Quest::findOrFail($id);
        $quests->title = $request->questTitle;
        $quests->desc = $request->questDesc;
        $quests->exp = $request->exp;
        $quests->level = $request->level;
        $quests->max_player = $request->maxPlayer;
        $quests->days_required = $request->daysRequired;
        $quests->id_subject = $request->subject;

        $quests->save();
        return redirect('showQuest')->with('success','Quest Updated Successfully');
    }

    public function destroyQuest($id){
        $quests = Quest::findOrFail($id);
        $quests->delete();
        return redirect('showQuest')->with('success','Quest Deleted Successfully');
    }

}
