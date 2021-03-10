<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class speedboatController extends Controller
{
    //
     public function view(){
        $dataSpeedboat=\App\Speedboat::all();
    	return view('Crud.speedboatView', compact('dataSpeedboat'));

    }

//Form Create Speedboat
    public function create(){
        return view('Crud.createSpeedboat');
    }

//Create Speedboat
    public function addSpeedboat(Request $request){
    \App\Speedboat::create([
        'nama_speedboat'=>$request->nama_speedboat,
        'kapasitas'=>$request->kapasitas,
        'deskripsi'=>$request->deskripsi,
        'tanggal_beroperasi'=>$request->tanggal_beroperasi,
        'foto'=>$request->foto,
        'contact_service'=>$request->contact_service,
    ]);
    return redirect('/Dashboard/CRUD/CreateSpeedboat');
}

//Update User
public function updateSpeedboat(Request $request){
    $dataUpdate=\App\Speedboat::find($request->id_speedboat);

    $dataUpdate->nama_speedboat=$request->nama_speedboat;
    $dataUpdate->kapasitas=$request->kapasitas;
    $dataUpdate->deskripsi=$request->deskripsi;
    $dataUpdate->foto=$request->foto;
    $dataUpdate->contact_service=$request->contact_service;
    $dataUpdate->tanggal_beroperasi=$request->tanggal_beroperasi;

    $dataUpdate->save();
    return redirect()->back();
}

//Delete User
    public function deleteSpeedboat($id){
    $deleteSpeedboat=\App\Speedboat::find($id);
    $deleteSpeedboat->delete();

    return redirect()->back();
    }

}
