<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class pelabuhanController extends Controller
{
    //
    public function index(){
    	return view('Page.Pelabuhan');
    }

    public function contact(){
    	return view('Page.pelabuhanContact');
    }

    public function view(){
    	return view('Crud.pelabuhanView');
    }
//Form Create
    public function create(){
    	return view('Crud.createPelabuhan');
    }

//Create Pelabuhan
public function addPelabuhan(Request $request)
{
    \App\Pelabuhan::create([
        'nama_pelabuhan'=>$request->nama_pelabuhan,
        'lokasi_pelabuhan'=>$request->lokasi_pelabuhan,
        'alamat_kantor'=>$request->alamat_kantor,
        'lama_beroperasi'=>$request->lama_beroperasi,
        'status'=>$request->status,
    ]);
    return redirect('/Dashboard/CRUD/CreatePelabuhan');
}


}
