<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class dermagaController extends Controller
{
    
//View Dermaga
    public function view(){
        $dataDermaga = \App\Dermaga::all();
        $pelabuhan = \App\Pelabuhan::all();
        return view('Crud.dermagaView', compact('dataDermaga','pelabuhan'));
    }

//Form Create
    public function create(){
        //Menampilkan data di form
        $pelabuhan=\App\Pelabuhan::all();

        return view('Crud.createDermaga', compact('pelabuhan'));
    }

//Create Dermaga
    public function addDermaga(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pelabuhan'=> 'required',
            'nama_dermaga'=> 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\Dermaga::create([
            'id_pelabuhan'=>$request->id_pelabuhan,
            'nama_dermaga'=>$request->nama_dermaga
        ]);
        return redirect('/Dashboard/CRUD/DermagaData')->with('success','Data berhasil dibuat!');

    }

//Update Golongan
    public function updateDermaga(Request $request){

        $validator = Validator::make($request->all(), [
            'id_pelabuhan'=> 'required',
            'nama_dermaga'=> 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataUpdate=\App\Dermaga::find($request->id_dermaga);

        $dataUpdate->id_pelabuhan=$request->id_pelabuhan;
        $dataUpdate->nama_dermaga=$request->nama_dermaga;
     

        $dataUpdate->save();
        return redirect()->back()->with('success','Data berhasil diupdate!');
    }

//Delete Golongan
    public function deleteDermaga($id){
        $deleteDermaga=\App\Dermaga::find($id);
        $deleteDermaga->delete();

        return redirect()->back()->with('info','Data berhasil di hapus!');
    }
}
