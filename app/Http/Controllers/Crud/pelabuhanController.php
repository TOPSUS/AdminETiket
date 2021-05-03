<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    if ($request->hasfile('file')) {
        $file = $request->file('file');
        $file_name = time() . "_" . $file->getClientOriginalName();
        $stored = Storage::disk('admin')->putFile('/image_pelabuhan', $file);
        \App\Pelabuhan::create([
            'nama_pelabuhan'=>$request->nama_pelabuhan,
            'lokasi_pelabuhan'=>$request->lokasi_pelabuhan,
            'alamat_kantor'=>$request->alamat_kantor,
            'foto'=>basename($stored),
            'lama_beroperasi'=>$request->lama_beroperasi,
            'status'=>$request->status,
            'tipe_pelabuhan'=>$request->tipe_pelabuhan,
        ]);
        return redirect('/Dashboard/CRUD/PelabuhanData');
    } else {
        \App\Pelabuhan::create([
            'nama_pelabuhan'=>$request->nama_pelabuhan,
            'lokasi_pelabuhan'=>$request->lokasi_pelabuhan,
            'alamat_kantor'=>$request->alamat_kantor,
            'lama_beroperasi'=>$request->lama_beroperasi,
            'status'=>$request->status,
            'tipe_pelabuhan'=>$request->tipe_pelabuhan,
        ]);
        return redirect('/Dashboard/CRUD/PelabuhanData');
    }

}

//Update Pelabuhan
public function updatePelabuhan(Request $request){
    $dataUpdate=\App\Pelabuhan::find($request->id_pelabuhan);

    if($dataUpdate){
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/image_pelabuhan', $file);
            $dataUpdate->nama_pelabuhan=$request->nama_pelabuhan;
            $dataUpdate->lokasi_pelabuhan=$request->lokasi_pelabuhan;
            $dataUpdate->alamat_kantor=$request->alamat_kantor;
            $dataUpdate->foto=basename($stored);
            $dataUpdate->lama_beroperasi=$request->lama_beroperasi;
            $dataUpdate->status=$request->status;
            $dataUpdate->tipe_pelabuhan=$request->tipe_pelabuhan;
            $dataUpdate->save();
            return redirect()->back();
        } else {
            $dataUpdate->nama_pelabuhan=$request->nama_pelabuhan;
            $dataUpdate->lokasi_pelabuhan=$request->lokasi_pelabuhan;
            $dataUpdate->alamat_kantor=$request->alamat_kantor;
            $dataUpdate->lama_beroperasi=$request->lama_beroperasi;
            $dataUpdate->status=$request->status;
            $dataUpdate->tipe_pelabuhan=$request->tipe_pelabuhan;
            $dataUpdate->save();
            return redirect()->back();
        }
    }
}

//Delete Pelabuhan
    public function deletePelabuhan($id){
    $deletePelabuhan=\App\Pelabuhan::find($id);
    $deletePelabuhan->delete();

    return redirect()->back();
    }


}
