<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class speedboatController extends Controller
{
    //
     public function view(){
    	return view('Crud.speedboatView');
    }

//Form Create Speedboat
    public function create(){
        return view('Crud.createSpeedboat');
    }

//Create Speedboat
    public function addSpeedboat(Request $request)
{
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
}
