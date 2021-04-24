<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class pelabuhanController extends Controller
{
    //
    public function index(){
        $dataPelabuhan=\App\Pelabuhan::all();
    	return view('Page.Pelabuhan', compact('dataPelabuhan'));
    }

    public function contact(){
    	return view('Page.pelabuhanContact');
    }

    public function view(){
        $dataPelabuhan=\App\Pelabuhan::all();
    	return view('Crud.pelabuhanView', compact('dataPelabuhan'));

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
        'deskripsi'=>$request->deskripsi,
        'foto'=>$request->foto,
        'lama_beroperasi'=>$request->lama_beroperasi,
        'status'=>$request->status,
        'tipe_pelabuhan'=>$request->tipe_pelabuhan,
    ]);
    return redirect('/Dashboard/CRUD/CreatePelabuhan');
}

//Update Pelabuhan
public function updatePelabuhan(Request $request){
    $dataUpdate=\App\Pelabuhan::find($request->id_pelabuhan);

    $dataUpdate->nama_pelabuhan=$request->nama_pelabuhan;
    $dataUpdate->lokasi_pelabuhan=$request->lokasi_pelabuhan;
    $dataUpdate->alamat_kantor=$request->alamat_kantor;
    $dataUpdate->deskripsi=$request->deskripsi;
    $dataUpdate->foto=$request->foto;
    $dataUpdate->lama_beroperasi=$request->lama_beroperasi;
    $dataUpdate->status=$request->status;
    $dataUpdate->tipe_pelabuhan=$request->tipe_pelabuhan;

    $dataUpdate->save();
    return redirect()->back();
}

//Delete Pelabuhan
    public function deletePelabuhan($id){
    $deletePelabuhan=\App\Pelabuhan::find($id);
    $deletePelabuhan->delete();

    return redirect()->back();
    }


}
