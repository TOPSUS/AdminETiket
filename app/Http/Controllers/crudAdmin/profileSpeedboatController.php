<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class profileSpeedboatController extends Controller
{

    //View Speedboat
    public function profile()
    {
        $IdAdmin = Auth::user()->id;
        $dataAdmin = \App\User::find($IdAdmin);
        $hakAkses = \App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');
        $profiles = \App\Kapal::whereIn('id', $hakAkses)->get();

        return view('pageAdminSpeedboat.profileSpeedboat', compact('profiles'));
    }

    //Form Create Speedboat
    public function createSpeedboat()
    {
        $IdAdmin = Auth::user()->id;
        $dataAdmin = \App\User::find($IdAdmin);
        $profile = \App\Kapal::find($dataAdmin->id_kapal);

        return view('CrudAdmin.createSpeedboat');

    }

    //Create Speedboat
    public function addSpeedboat(Request $request)
    {
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $stored = Storage::disk('admin')->putFile('/kapal_image', $file);
            \App\Speedboat::create([
                'nama_speedboat' => $request->nama_speedboat,
                'kapasitas' => $request->kapasitas,
                'deskripsi' => $request->deskripsi,
                'tanggal_beroperasi' => $request->tanggal_beroperasi,
                'foto' => basename($stored),
                'contact_service' => $request->contact_service,
            ]);
            return redirect('/ProfileSpeedboat');
        } else {
            \App\Speedboat::create([
                'nama_speedboat' => $request->nama_speedboat,
                'kapasitas' => $request->kapasitas,
                'deskripsi' => $request->deskripsi,
                'tanggal_beroperasi' => $request->tanggal_beroperasi,
                'contact_service' => $request->contact_service,
            ]);
            return redirect('/ProfileSpeedboat');
        }

    }

    //Update Speedboat
    public function updateSpeedboat(Request $request)
    {
        $dataUpdate = \App\Kapal::find($request->id_kapal);

        $validator = Validator::make($request->all(), [
            'nama_kapal'=>'required',
            'kapasitas'=>'required',
            'deskripsi'=>'required',
            'contact_service'=>'required',
            'tanggal_beroperasi'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $stored = Storage::disk('admin')->putFile('/kapal_image',$file);
            $dataUpdate->nama_kapal = $request->nama_kapal;
            $dataUpdate->kapasitas = $request->kapasitas;
            $dataUpdate->deskripsi = $request->deskripsi;
            $dataUpdate->foto = basename($stored);
            $dataUpdate->contact_service = $request->contact_service;
            $dataUpdate->tanggal_beroperasi = $request->tanggal_beroperasi;
            $dataUpdate->save();
            return redirect('/ProfileKapal');
        } else {
            $dataUpdate->nama_kapal = $request->nama_kapal;
            $dataUpdate->kapasitas = $request->kapasitas;
            $dataUpdate->deskripsi = $request->deskripsi;
            $dataUpdate->contact_service = $request->contact_service;
            $dataUpdate->tanggal_beroperasi = $request->tanggal_beroperasi;

            $dataUpdate->save();
            return redirect('/ProfileKapal');
        }
    }

    //Delete Speedboat
    public function deleteSpeedboat($id)
    {
        $deleteSpeedboat = \App\Kapal::find($id);
        $deleteSpeedboat->delete();

        return redirect('/ProfileSpeedboat')->with('success', 'Berita berhasil dihapus!');
    }


}
