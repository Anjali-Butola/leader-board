<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Http\Request;

class LeaderBoardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;
        $query = User::select('id', 'name', 'total_score', 'rank');
        if(!empty($request->search)){
            $query = $query->where('id', $request->search);
        }
        $users = $query->orderBy('id','ASC')->get();

        return view('leader-board.index',compact('users'));
    }

    public function recalculate()
    {
        $users = User::get();
        foreach($users as $user){
            $scores = UserPoint::where('user_id',$user->id)->pluck('points')->toArray();
            $user->update(['total_score' => array_sum($scores)]);
        }

        $users = User::orderBy('total_score','DESC')->get();
        foreach($users as $key=>$user){
            $user->rank = $key + 1;
            $user->save();
        }

        return response()->json(['success' => true, 'message' => 'Recalculated successfully.']);
    }
}
