<?php

namespace App\Http\Controllers;

use App\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class AchievementController extends Controller
{
    public function index(){
        $achs = Achievement::all();
        return view('achievements.achievement', compact(['achs']));
    }

    public function form(){
        return view('achievements.achievementform');
    }

    public function achievementsList(){
        $ach = Achievement::all();

        return view('client.clientachievementlist', compact(['ach']));
    }

    public function addAch(Request $request){
        if($request->hasFile('icon')){
            $ach = new Achievement();
            $ach->ach_title = $request->achTitle;
            $ach->ach_desc = $request->desc;
            $ach->hr_reward = $request->reward;

            $icon = $request->file('icon');
            $filename = time().'.'.$icon->getClientOriginalExtension();
            Image::make($icon)->resize(100, 100)->save(public_path('upload/icon/'.$filename));

            $ach->ach_icon = $filename;
            $ach->save();

            return redirect()->route('achievement')->with('success','Achievement Added Successfully');
        }else{
            return redirect()->route('achievement')->with('error','Achievement Added Failed');
        }

    }

    public function update(Request $request, $id){
        if($request->hasFile('icon')){
            $icon = $request->file('icon');
            $filename = time().'.'.$icon->getClientOriginalExtension();
            Image::make($icon)->resize(100, 100)->save(public_path('upload/icon/'.$filename));

            $ach = DB::table('achievements')
                ->where('id', '=', $id)
                ->update(
                    [
                        'ach_title' => $request->achTitle,
                        'ach_desc' => $request->desc,
                        'hr_reward' => $request->reward,
                        'ach_icon' => $filename
                    ]
                );
        }else{
            $ach = DB::table('achievements')
                ->where('id', '=', $id)
                ->update(
                    [
                        'ach_title' => $request->achTitle,
                        'ach_desc' => $request->desc,
                        'hr_reward' => $request->reward,
                    ]
                );
        }

        return redirect()->route('achievement')->with('success','Achievement Updated Successfully');
    }

    public function achEdit($id){
        $ach = Achievement::findOrFail($id);
        return view('achievements.achievementedit', compact(['ach']));
    }

    public function destroy($id){
        $users = Achievement::findOrFail($id);
        $users->delete();

        return redirect()->route('achievement')->with('success','Achievement Deleted Successfully');
    }
}
