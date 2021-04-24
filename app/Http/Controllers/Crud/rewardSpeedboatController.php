<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class rewardSpeedboatController extends Controller
{
//View Reward Speedboat
    public function view(){
        $dataRewardSpeedboat=\App\rewardSpeedboat::with('kapal')->get();
        $kapal=\App\Kapal::where('tipe_kapal','speedboat')->get();
    	return view('Crud.rewardSpeedboatView', compact('kapal','dataRewardSpeedboat'));
    }

//Form Create Reward Speedboat
    public function create(){
        $speedboat=\App\Kapal::where('tipe_kapal','kapal')->get();

        return view('Crud.createRewardSpeedboat', compact('speedboat'));
    }

//Create Reward Speedboat
    public function addRewardSpeedboat(Request $request)
    {
        \App\rewardSpeedboat::create([
            'id_speedboat'=>$request->id_speedboat,
            'reward'=>$request->reward,
            'berlaku'=>$request->berlaku,
            'minimal_point'=>$request->minimal_point,
            'foto'=>$request->foto,
        ]);   
        return view('Crud.rewardSpeedboatView');
    }
//Update Reward Speedboat
    public function updateRewardSpeedboat(Request $request){
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
    public function deleteRewardSpeedboat($id){
        $deleteRewardSpeedboat=\App\rewardSpeedboat::find($id);
        $deleteRewardSpeedboat->delete();

        return redirect()->back();
}

}
