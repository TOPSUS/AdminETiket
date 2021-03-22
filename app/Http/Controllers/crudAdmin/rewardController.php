<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class rewardController extends Controller
{
    //View Reward Speedboat
    public function view(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $dataRewardSpeedboat=\App\rewardSpeedboat::with('speedboat')->get();
        //$speedboat=\App\rewardSpeedboat::get();

    	return view('pageAdminSpeedboat.rewardSpeedboatAdmin', compact('speedboat','dataRewardSpeedboat'));
    }

//Form Create Reward Speedboat
    public function create(){

        //$speedboat=\App\Speedboat::all();
        //$dataRewardSpeedboat=\App\rewardSpeedboat::with('speedboat')->get();

        return view('CrudAdmin.createRewardSpeedboat', compact('speedboat'));
    }

//Create Reward Speedboat
    public function addReward(Request $request)
    {
        $IdUser=Auth::user()->id;
        $IdSpeedboat=\App\User::find($IdUser);
        $dataRewardSpeedboat= new \App\rewardSpeedboat();

        $dataRewardSpeedboat-> id_speedboat = $IdSpeedboat->id_speedboat;
        $dataRewardSpeedboat-> reward = $request->reward;
        $dataRewardSpeedboat-> berlaku = $request->berlaku;
        $dataRewardSpeedboat-> minimal_point = $request->minimal_point;
        $dataRewardSpeedboat-> foto = $request->foto;
        $dataRewardSpeedboat-> id_user = $IdUser;
            
        $dataRewardSpeedboat->save();
        return redirect('/Reward');
    }
//Update Reward Speedboat
    public function updateReward(Request $request){
        $IdUser=Auth::user()->id;
        $IdSpeedboat=\App\User::find($IdUser);
        //$dataUpdate = \App\rewardSpeedboat::find(rewardSpeedboat()->id);
        $dataUpdate=\App\rewardSpeedboat::find($request->id_reward_speedboat);

        $dataUpdate->id_speedboat =$IdSpeedboat->id_speedboat ;
        $dataUpdate->reward=$request->reward;
        $dataUpdate->berlaku=$request->berlaku;
        $dataUpdate->minimal_point =$request->minimal_point;
        $dataUpdate->foto =$request->foto;

        $dataUpdate->save();
        return redirect()->back();
    }

//Delete Reward Speedboat
    public function deleteReward($id){
        $deleteRewardSpeedboat=\App\rewardSpeedboat::find($id);
        $deleteRewardSpeedboat->delete();

        return redirect()->back();
    }
}
