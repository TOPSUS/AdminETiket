<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class rewardSpeedboatController extends Controller
{
//View Reward Speedboat
    public function view()
    {
        $dataRewardSpeedboat = \App\rewardSpeedboat::with('kapal')->get();
        $kapal = \App\Kapal::where('tipe_kapal', 'speedboat')->get();
        return view('Crud.rewardSpeedboatView', compact('kapal', 'dataRewardSpeedboat'));
    }

//Form Create Reward Speedboat
    public function create()
    {
        $speedboat = \App\Kapal::where('tipe_kapal', 'speedboat')->get();

        return view('Crud.createRewardSpeedboat', compact('speedboat'));
    }

//Create Reward Speedboat
    public function addRewardSpeedboat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_speedboat' => 'required',
            'reward' => 'required',
            'berlaku' => 'required',
            'minimal_point' => 'required',
            'file' => 'required|file|image',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/reward_image', $file);
            \App\rewardSpeedboat::create([
                'id_speedboat' => $request->id_speedboat,
                'reward' => $request->reward,
                'berlaku' => $request->berlaku,
                'minimal_point' => $request->minimal_point,
                'foto' => basename($stored),
            ]);
            return redirect('/Dashboard/CRUD/RewardSpeedboatData')->with('success','Data Berhasil ditambahkan!');
        } else {
            \App\rewardSpeedboat::create([
                'id_speedboat' => $request->id_speedboat,
                'reward' => $request->reward,
                'berlaku' => $request->berlaku,
                'minimal_point' => $request->minimal_point,
            ]);
            return redirect('/Dashboard/CRUD/RewardSpeedboatData')->with('success','Data Berhasil diupdate!');;
        }

    }

//Update Reward Speedboat
    public function updateRewardSpeedboat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_speedboat' => 'required',
            'reward' => 'required',
            'berlaku' => 'required',
            'minimal_point' => 'required',
            'file' => 'required|file|image',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataUpdate = \App\rewardSpeedboat::find($request->id_reward_speedboat);
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/reward_image', $file);
            $dataUpdate->id_speedboat = $request->id_speedboat;
            $dataUpdate->reward = $request->reward;
            $dataUpdate->berlaku = $request->berlaku;
            $dataUpdate->minimal_point = $request->minimal_point;
            $dataUpdate->foto = basename($stored);
            $dataUpdate->save();
            return redirect()->back()->with('success','Data Berhasil diupdate!');;
        } else {
            $dataUpdate->id_speedboat = $request->id_speedboat;
            $dataUpdate->reward = $request->reward;
            $dataUpdate->berlaku = $request->berlaku;
            $dataUpdate->minimal_point = $request->minimal_point;
            $dataUpdate->save();
            return redirect()->back()->with('success','Data Berhasil diupdate!');;
        }
    }

//Delete Reward Speedboat
    public function deleteRewardSpeedboat($id)
    {
        $deleteRewardSpeedboat = \App\rewardSpeedboat::find($id);
        $deleteRewardSpeedboat->delete();

        return redirect()->back()->with('info','Data Berhasil dihapus!');;
    }

}
