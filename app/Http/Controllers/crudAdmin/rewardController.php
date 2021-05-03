<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class rewardController extends Controller
{
    //View Reward Speedboat
    public function index()
    {
        $IdAdmin = Auth::user()->id;
        $dataAdmin = \App\User::find($IdAdmin);

        //Ambil Id kapal
        $idKapal = \App\hakAksesKapal::where('id_user', Auth::user()->id)->pluck('id_kapal');
        $kapal = \App\Kapal::whereIn('id',$idKapal)->get();
        $dataRewardSpeedboat = \App\rewardSpeedboat::whereIn('id_speedboat', $idKapal)->with('kapal')->get();
        //$speedboat=\App\rewardSpeedboat::get();

        return view('pageAdminSpeedboat.rewardSpeedboatAdmin', compact('dataRewardSpeedboat','kapal'));
    }

//Form Create Reward Speedboat
    public function create()
    {
        //$IdAdmin = Auth::user()->id;
        //$dataAdmin=\App\User::find($IdAdmin);
        //$speedboat=\App\Speedboat::all();

        $idKapal = \App\hakAksesKapal::where('id_user',Auth::user()->id)->where('hak_akses','Admin')->pluck('id_kapal');
        $kapal = \App\Kapal::whereIn('id',$idKapal)->get();

        return view('CrudAdmin.createRewardSpeedboat', compact('kapal'));
        //return view('/RewardSpeedboat/CreateRewardSpeedboat');
    }

//Create Reward Speedboat
    public function addReward(Request $request)
    {
        if($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time()."_".$file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/reward_image', $file);
            $dataRewardSpeedboat = new \App\rewardSpeedboat();
            $dataRewardSpeedboat->id_speedboat = $request->id_kapal;
            $dataRewardSpeedboat->reward = $request->reward;
            $dataRewardSpeedboat->berlaku = $request->berlaku;
            $dataRewardSpeedboat->minimal_point = $request->minimal_point;
            $dataRewardSpeedboat->foto = $file_name;
            $dataRewardSpeedboat->save();
            return redirect('/RewardSpeedboat');
        } else {
            $dataRewardSpeedboat = new \App\rewardSpeedboat();
            $dataRewardSpeedboat->id_speedboat = $request->id_kapal;
            $dataRewardSpeedboat->reward = $request->reward;
            $dataRewardSpeedboat->berlaku = $request->berlaku;
            $dataRewardSpeedboat->minimal_point = $request->minimal_point;
            $dataRewardSpeedboat->foto = null;
            $dataRewardSpeedboat->save();
            return redirect('/RewardSpeedboat');
        }
    }

//Update Reward Speedboat
    public function updateReward(Request $request)
    {
        $dataUpdate = \App\rewardSpeedboat::find($request->id_reward_speedboat);
        if($request->hasfile('file')) {
            $file = $request->file('file');
            $stored = Storage::disk('admin')->putFile('/reward_image', $file);
            $dataUpdate->id_speedboat = $request->id_kapal;
            $dataUpdate->reward = $request->reward;
            $dataUpdate->berlaku = $request->berlaku;
            $dataUpdate->minimal_point = $request->minimal_point;
            $dataUpdate->foto = basename($stored);
            $dataUpdate->save();
            return redirect()->back();
        } else {
            $dataUpdate->id_speedboat = $request->id_kapal;
            $dataUpdate->reward = $request->reward;
            $dataUpdate->berlaku = $request->berlaku;
            $dataUpdate->minimal_point = $request->minimal_point;
            $dataUpdate->save();
            return redirect()->back();
        }
    }

//Delete Reward Speedboat
    public function deleteReward($id)
    {
        $deleteRewardSpeedboat = \App\rewardSpeedboat::find($id);
        $deleteRewardSpeedboat->delete();
        return redirect()->back();
    }
}
