<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $dataPelabuhan=\App\Pelabuhan::whereIn('tipe_pelabuhan',['speedboat','speedboat & feri'])->get();
        return view('Crud.createSpeedboat',compact('dataPelabuhan'));
    }

//Create Speedboat
    public function addSpeedboat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_speedboat' => 'required',
            'kapasitas' => 'required',
            'deskripsi' => 'required',
            'tanggal_beroperasi' => 'required',
            'file' => 'required',
            'contact_service' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/kapal_image', $file);
            $anggota =\App\Kapal::create([
                'nama_kapal' => $request->nama_speedboat,
                'kapasitas' => $request->kapasitas,
                'deskripsi' => $request->deskripsi,
                'tanggal_beroperasi' => $request->tanggal_beroperasi,
                'foto' => basename($stored),
                'tipe_kapal' => 'speedboat',
                'contact_service' => $request->contact_service,
            ]);
            $anggotaPelabuhan= \App\anggotaPelabuhan::create([
                'id_kapal'=>$anggota->id,
                'id_pelabuhan'=>$request->id_pelabuhan,
                'status'=>'pending',
    
            ]);
            return redirect('Dashboard/CRUD/SpeedboatData')->with('success','Data Berhasil ditambahkan!');;

        } else {
            $anggota = \App\Kapal::create([
                'nama_kapal' => $request->nama_speedboat,
                'kapasitas' => $request->kapasitas,
                'deskripsi' => $request->deskripsi,
                'tanggal_beroperasi' => $request->tanggal_beroperasi,
                'tipe_kapal' => 'speedboat',
                'contact_service' => $request->contact_service,
            ]);
            $anggotaPelabuhan= \App\anggotaPelabuhan::create([
                'id_kapal'=>$anggota->id,
                'id_pelabuhan'=>$request->id_pelabuhan,
                'status'=>'pending',
    
            ]);
            return redirect('Dashboard/CRUD/SpeedboatData')->with('success','Data Berhasil ditambahkan!');;
        }
    }

//Update Speedboat
    public function updateSpeedboat(Request $request)
    {


        $dataUpdate = \App\Kapal::find($request->id_kapal);
        if ($request->hasfile('file')) {
            $validator = Validator::make($request->all(), [
                'nama_speedboat' => 'required',
                'kapasitas' => 'required',
                'deskripsi' => 'required',
                'tanggal_beroperasi' => 'required',
                'file' => 'required',
                'contact_service' => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

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
            return redirect()->back()->with('success','Data Berhasil diupdate!');
        } else {
            $validator = Validator::make($request->all(), [
                'nama_speedboat' => 'required',
                'kapasitas' => 'required',
                'deskripsi' => 'required',
                'tanggal_beroperasi' => 'required',
                'contact_service' => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $dataUpdate->nama_kapal = $request->nama_speedboat;
            $dataUpdate->kapasitas = $request->kapasitas;
            $dataUpdate->deskripsi = $request->deskripsi;
            $dataUpdate->tipe_kapal = $request->tipe_kapal;
            $dataUpdate->contact_service = $request->contact_service;
            $dataUpdate->tanggal_beroperasi = $request->tanggal_beroperasi;
            $dataUpdate->save();
            return redirect()->back()->with('success','Data Berhasil diupdate!');
        }
    }

//Delete Speedboat
    public function deleteSpeedboat($id)
    {
        $deleteSpeedboat = \App\Kapal::find($id);
        $deleteSpeedboat->delete();

        return redirect()->back()->with('info','Data Berhasil dihapus!');
    }

}
