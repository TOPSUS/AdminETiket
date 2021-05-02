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
        $speedboat=\App\Kapal::where('tipe_kapal','speedboat')->get();

        return view('Crud.createRewardSpeedboat', compact('speedboat'));
    }

//Create Reward Speedboat
    public function addRewardSpeedboat(Request $request)
    {
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path() . '/reward/', $file_name);
            \App\rewardSpeedboat::create([
                'id_speedboat'=>$request->id_speedboat,
                'reward'=>$request->reward,
                'berlaku'=>$request->berlaku,
                'minimal_point'=>$request->minimal_point,
                'foto'=>$file_name,
            ]);
            return redirect('/Dashboard/CRUD/RewardSpeedboatData');
        } else {
            \App\rewardSpeedboat::create([
                'id_speedboat'=>$request->id_speedboat,
                'reward'=>$request->reward,
                'berlaku'=>$request->berlaku,
                'minimal_point'=>$request->minimal_point,
            ]);
            return redirect('/Dashboard/CRUD/RewardSpeedboatData');
        }

    }
//Update Reward Speedboat
    public function updateRewardSpeedboat(Request $request){
        $dataUpdate=\App\rewardSpeedboat::find($request->id_reward_speedboat);
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path() . '/reward/', $file_name);
            $dataUpdate->id_speedboat =$request->id_speedboat;
            $dataUpdate->reward=$request->reward;
            $dataUpdate->berlaku=$request->berlaku;
            $dataUpdate->minimal_point =$request->minimal_point;
            $dataUpdate->foto=$file_name;
            $dataUpdate->save();
            return redirect()->back();
        } else {
            $dataUpdate->id_speedboat =$request->id_speedboat;
            $dataUpdate->reward=$request->reward;
            $dataUpdate->berlaku=$request->berlaku;
            $dataUpdate->minimal_point =$request->minimal_point;
            $dataUpdate->save();
            return redirect()->back();
        }
}

//Delete Reward Speedboat
    public function deleteRewardSpeedboat($id){
        $deleteRewardSpeedboat=\App\rewardSpeedboat::find($id);
        $deleteRewardSpeedboat->delete();

        return redirect()->back();
}

}
