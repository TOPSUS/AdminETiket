<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class kapalController extends Controller
{
//
    public function view(){
        $dataKapal=\App\Kapal::where('tipe_kapal','feri')->get();
    	return view('Crud.kapalView', compact('dataKapal'));
    }

//Form Create Kapal
    public function create(){
        return view('Crud.createKapal');
    }

//Create Kapal
    public function addKapal(Request $request){

        $validator = Validator::make($request->all(), [
            'nama_kapal' => 'required',
            'kapasitas'=>'required',
            'deskripsi'=>'required',
            'contact_service'=>'required|numeric',
            'tanggal_beroperasi'=>'required',
            'file'=>'required|file|image',
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
            \App\Kapal::create([
                'nama_kapal'=>$request->nama_kapal,
                'kapasitas'=>$request->kapasitas,
                'deskripsi'=>$request->deskripsi,
                'contact_service'=>$request->contact_service,
                'foto'=>basename($stored),
                'tanggal_beroperasi'=>$request->tanggal_beroperasi,
                'tipe_kapal'=>'feri'

            ]);
            return redirect('/Dashboard/CRUD/KapalData')->with('success','Data berhasil ditambahkan');
        } else {
            \App\Kapal::create([
                'nama_kapal'=>$request->nama_kapal,
                'kapasitas'=>$request->kapasitas,
                'deskripsi'=>$request->deskripsi,
                'contact_service'=>$request->contact_service,
                'tanggal_beroperasi'=>$request->tanggal_beroperasi,
                'tipe_kapal'=>'feri'
            ]);
            return redirect('/Dashboard/CRUD/KapalData')->with('success','Data berhasil ditambahkan!!');
        }
    }
//Update Kapal
    public function updateKapal(Request $request){

        $dataUpdate=\App\Kapal::find($request->id_kapal);
        if ($request->hasfile('file')) {
            $validator = Validator::make($request->all(), [
                'nama_kapal' => 'required',
                'kapasitas'=>'required',
                'deskripsi'=>'required',
                'contact_service'=>'required|numeric',
                'tanggal_beroperasi'=>'required',
                'file'=>'required|file|image',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/kapal_image', $file);
            $dataUpdate->nama_kapal=$request->nama_kapal;
            $dataUpdate->kapasitas = $request->kapasitas;
            $dataUpdate->deskripsi = $request->deskripsi;
            $dataUpdate->contact_service = $request->contact_service;
            $dataUpdate->foto=basename($stored);
            $dataUpdate->tanggal_beroperasi=$request->tanggal_beroperasi;
            $dataUpdate->save();
            return redirect()->back()->with('success','Data berhasil diupdate');;
        } else {
            $validator = Validator::make($request->all(), [
                'nama_kapal' => 'required',
                'kapasitas'=>'required',
                'deskripsi'=>'required',
                'contact_service'=>'required|numeric',
                'tanggal_beroperasi'=>'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $dataUpdate->nama_kapal = $request->nama_kapal;
            $dataUpdate->kapasitas = $request->kapasitas;
            $dataUpdate->deskripsi = $request->deskripsi;
            $dataUpdate->contact_service = $request->contact_service;
            $dataUpdate->tanggal_beroperasi = $request->tanggal_beroperasi;
            $dataUpdate->save();
            return redirect()->back()->with('success','Data berhasil diupdate');;
        }
    }

//Delete Kapal
    public function deleteKapal($id){
        $deleteKapal=\App\Kapal::find($id);
        $deleteKapal->delete();

        return redirect()->back()->with('info','Data berhasil dihapus!');
        }
}
