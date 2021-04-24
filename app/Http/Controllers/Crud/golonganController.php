<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class golonganController extends Controller
{
//View Golongan
    public function view(){
        $dataGolongan = \App\Golongan::all();
        $pelabuhan=\App\Pelabuhan::all();
        return view('Crud.golonganView', compact('dataGolongan','pelabuhan'));
    }
//Form Create
    public function create(){
        //Menampilkan data di form 
        $pelabuhan=\App\Pelabuhan::all();

        return view('Crud.createGolongan', compact('pelabuhan'));
    }

//Create Golongan
    public function addGolongan(Request $request)
    {
        \App\Golongan::create([
            'id_pelabuhan'=>$request->id_pelabuhan,
            'golongan'=>$request->golongan,
            'keterangan'=>$request->keterangan,
            'harga'=>$request->harga,
        ]);
        return redirect('/Dashboard/CRUD/Golongan')->with('success','Data berhasil dibuat!');

    }

//Update Golongan
    public function updateGolongan(Request $request){
        $dataUpdate=\App\Golongan::find($request->id_golongan);

        $dataUpdate->id_pelabuhan=$request->id_pelabuhan;
        $dataUpdate->golongan=$request->golongan;
        $dataUpdate->keterangan=$request->keterangan;
        $dataUpdate->harga =$request->harga;

        $dataUpdate->save();
        return redirect()->back();
    }

//Delete Golongan
    public function deleteGolongan($id){
        $deleteGolongan=\App\Golongan::find($id);
        $deleteGolongan->delete();

        return redirect()->back();
    }
}
