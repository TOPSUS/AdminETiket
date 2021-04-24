<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class kapalController extends Controller
{
//
    public function view(){
        $dataKapal=\App\Kapal::where('tipe_kapal','feri')->get();
    	return view('Crud.kapalView', compact('dataKapal'));
    }
    
//Form Create Speedboat
    public function create(){
        return view('Crud.createKapal');
    }
//Create Speedboat
    public function addKapal(Request $request){
        \App\Kapal::create([
            'nama_kapal'=>$request->nama_kapal,
            'deskripsi'=>$request->deskripsi,
            'foto'=>$request->foto,
            'tanggal_beroperasi'=>$request->tanggal_beroperasi,
           
        ]);
        return redirect('/Dashboard/CRUD/KapalData');
    }
//Update Kapal
    public function updateKapal(Request $request){
        $dataUpdate=\App\Kapal::find($request->id_kapal);

        $dataUpdate->nama_kapal=$request->nama_kapal;
        $dataUpdate->deskripsi=$request->deskripsi;
        $dataUpdate->foto=$request->foto;
        $dataUpdate->tanggal_beroperasi=$request->tanggal_beroperasi;

        $dataUpdate->save();
        return redirect()->back();
    }
//Delete Kapal
    public function deleteKapal($id){
        $deleteKapal=\App\Kapal::find($id);
        $deleteKapal->delete();

        return redirect()->back();
        }
}
