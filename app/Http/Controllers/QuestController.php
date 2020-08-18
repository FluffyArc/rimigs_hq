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
        $quest->id_subject = "1";

        $quest->save();

        return redirect('showQuest')->with('mssg','Quest Added Successfully');
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


}
