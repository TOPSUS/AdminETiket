<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class speedboatController extends Controller
{
    //
    public function view()
    {
        $dataSpeedboat = \App\Kapal::where('tipe_kapal', 'speedboat')->get();
        return view('Crud.speedboatView', compact('dataSpeedboat'));

    }

//Form Create Speedboat
    public function create()
    {
        return view('Crud.createSpeedboat');
    }

//Create Speedboat
    public function addSpeedboat(Request $request)
    {
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/kapal_image', $file);
            \App\Kapal::create([
                'nama_kapal' => $request->nama_speedboat,
                'kapasitas' => $request->kapasitas,
                'deskripsi' => $request->deskripsi,
                'tanggal_beroperasi' => $request->tanggal_beroperasi,
                'foto' => basename($stored),
                'tipe_kapal' => 'speedboat',
                'contact_service' => $request->contact_service,
            ]);
            return redirect('/Dashboard/CRUD/CreateSpeedboat');

        } else {
            \App\Kapal::create([
                'nama_kapal' => $request->nama_speedboat,
                'kapasitas' => $request->kapasitas,
                'deskripsi' => $request->deskripsi,
                'tanggal_beroperasi' => $request->tanggal_beroperasi,
                'tipe_kapal' => 'speedboat',
                'contact_service' => $request->contact_service,
            ]);
            return redirect('/Dashboard/CRUD/CreateSpeedboat');
        }
    }

//Update Speedboat
    public function updateSpeedboat(Request $request)
    {
        $dataUpdate = \App\Kapal::find($request->id_kapal);
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/kapal_image', $file);
            $dataUpdate->nama_kapal = $request->nama_speedboat;
            $dataUpdate->kapasitas = $request->kapasitas;
            $dataUpdate->deskripsi = $request->deskripsi;
            $dataUpdate->foto = basename($stored);
            $dataUpdate->tipe_kapal = $request->tipe_kapal;
            $dataUpdate->contact_service = $request->contact_service;
            $dataUpdate->tanggal_beroperasi = $request->tanggal_beroperasi;
            $dataUpdate->save();
            return redirect()->back();
        } else {
            $dataUpdate->nama_kapal = $request->nama_speedboat;
            $dataUpdate->kapasitas = $request->kapasitas;
            $dataUpdate->deskripsi = $request->deskripsi;
            $dataUpdate->tipe_kapal = $request->tipe_kapal;
            $dataUpdate->contact_service = $request->contact_service;
            $dataUpdate->tanggal_beroperasi = $request->tanggal_beroperasi;
            $dataUpdate->save();
            return redirect()->back();
        }


    }

//Delete Speedboat
    public function deleteSpeedboat($id)
    {
        $deleteSpeedboat = \App\Kapal::find($id);
        $deleteSpeedboat->delete();

        return redirect()->back();
    }

}
