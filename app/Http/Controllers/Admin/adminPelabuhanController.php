<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class adminPelabuhanController extends Controller
{
//
    public function index(){
    	return view('adminPelabuhan.homeAdmin');
    }

//Pelabuhan
    public function pelabuhan($id){
        $user_id = $id;
        $dataHakAkses=\App\hakAksesPelabuhan::where('id_user',$id)->where('hak_akses','PAdmin')->pluck('id_pelabuhan');
        $dataPelabuhan = \App\Pelabuhan::whereIn('id',$dataHakAkses)->get();
        return view('Crud.adminPelabuhan', compact('dataPelabuhan','user_id'));
    }

//Form Create Pelabuhan
    public function createpelabuhan($id){
        $id1=$id;
        return view('Crud.adminCreatePelabuhan', compact('id1'));
    }

//Create Pelabuhan
    public function addPelabuhan(Request $request){

        $validator = Validator::make($request->all(), [
            'kode_pelabuhan' => 'required',
            'nama_pelabuhan' => 'required',
            'lokasi_pelabuhan' => 'required',
            'alamat_kantor' => 'required',
            'lama_beroperasi' => 'required',
            'status' => 'required',
            'tipe_pelabuhan' => 'required',
            'file' => 'required|file|image',
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
            $dataPelabuhan=\App\Pelabuhan::create([
                'kode_pelabuhan' =>$request->kode_pelabuhan,
                'nama_pelabuhan' => $request->nama_pelabuhan,
                'lokasi_pelabuhan' => $request->lokasi_pelabuhan,
                'alamat_kantor' => $request->alamat_kantor,
                'foto' => basename($stored),
                'lama_beroperasi' => $request->lama_beroperasi,
                'status' => $request->status,
                'tipe_pelabuhan' => $request->tipe_pelabuhan,
            ]);

            \App\hakAksesPelabuhan::create([
                'id_user'=>$request->id_padmin,
                'id_pelabuhan'=>$dataPelabuhan->id,
                'hak_akses'=>'PAdmin',
            ]);
            return redirect('/Dashboard/CRUD/AdminPelabuhanData/Pelabuhan/View/'.$request->id_padmin)->with('success','Data Berhasil ditambahkan');
        } else {
            $dataPelabuhan=\App\Pelabuhan::create([
                'kode_pelabuhan' =>$request->kode_pelabuhan,
                'nama_pelabuhan' => $request->nama_pelabuhan,
                'lokasi_pelabuhan' => $request->lokasi_pelabuhan,
                'alamat_kantor' => $request->alamat_kantor,
                'foto' => basename($stored),
                'lama_beroperasi' => $request->lama_beroperasi,
                'status' => $request->status,
                'tipe_pelabuhan' => $request->tipe_pelabuhan,
            ]);

            \App\hakAksesPelabuhan::create([
                'id_user'=>$request->id_padmin,
                'id_pelabuhan'=>$dataPelabuhan->id,
                'hak_akses'=>'PAdmin',
            ]);
            return redirect('/Dashboard/CRUD/AdminPelabuhanData/Pelabuhan/View/'.$request->id_padmin)->with('success','Data Berhasil ditambahkan');
        }

    }

}
