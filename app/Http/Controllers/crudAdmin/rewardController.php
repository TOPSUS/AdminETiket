<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class rewardController extends Controller
{
    //View Reward Speedboat
    public function index(){
        $dataRewardSpeedboat=\App\rewardSpeedboat::with('speedboat')->get();
        $speedboat=\App\Speedboat::all();
    	return view('pageAdminSpeedboat.rewardSpeedboatAdmin', compact('speedboat','dataRewardSpeedboat'));
    }

//Form Create Reward Speedboat
    public function create(){
        $speedboat=\App\Speedboat::all();

        return view('CrudAdmin.createRewardSpeedboat', compact('speedboat'));
    }

//Create Reward Speedboat
    public function addReward(Request $request)
    {
        \App\rewardSpeedboat::create([
            'id_speedboat'=>$request->id_speedboat,
            'reward'=>$request->reward,
            'berlaku'=>$request->berlaku,
            'minimal_point'=>$request->minimal_point,
            'foto'=>$request->foto,
        ]);   
        return view('pageAdminSpeedboat.rewardSpeedboatAdmin');
    }
//Update Reward Speedboat
    public function updateReward(Request $request){
        $dataUpdate=\App\rewardSpeedboat::find($request->id_reward_speedboat);

        $dataUpdate->id_speedboat =$request->id_speedboat ;
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
