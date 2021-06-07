<?php

namespace App\Http\Controllers\PAdmin;

use App\hakAksesPelabuhan;
use App\Http\Controllers\Controller;
use App\Pelabuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class golonganController extends Controller
{
//View Golongan
    public function index(){
        $hakAkses = hakAksesPelabuhan::where('id_user',Auth::user()->id)->pluck('id_pelabuhan');
        $pelabuhan = Pelabuhan::whereIn('id',$hakAkses)->whereIn('tipe_pelabuhan',['feri','speedboat & feri'])->get();
        $dataGolongan = \App\Golongan::whereIn('id_pelabuhan',$hakAkses)->with('pelabuhan')->get();
        return view('PAdmin.golonganView', compact('dataGolongan'));
    }
//Form Create
    public function create(){
        $hakAkses = hakAksesPelabuhan::where('id_user',Auth::user()->id)->pluck('id_pelabuhan');
        $pelabuhan = Pelabuhan::whereIn('id',$hakAkses)->whereIn('tipe_pelabuhan',['feri','speedboat & feri'])->get();

        return view('PAdmin.createGolongan', compact('pelabuhan'));
    }

//Create Golongan
    public function addGolongan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pelabuhan'=> 'required',
            'golongan'=> 'required',
            'keterangan'=> 'required',
            'harga'=> 'required|numeric',
            'max_penumpang'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\Golongan::create([
            'id_pelabuhan'=>$request->id_pelabuhan,
            'golongan'=>$request->golongan,
            'keterangan'=>$request->keterangan,
            'harga'=>$request->harga,
            'max_penumpang'=>$request->max_penumpang,
        ]);
        return redirect(route('golongan-pa'))->with('success','Data berhasil dibuat!');

    }

//Update Golongan
    public function updateGolongan(Request $request){

        $validator = Validator::make($request->all(), [
            'golongan'=> 'required',
            'keterangan'=> 'required',
            'harga'=> 'required|numeric',
            'max_penumpang'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataUpdate=\App\Golongan::find($request->id_golongan);

        $dataUpdate->golongan=$request->golongan;
        $dataUpdate->keterangan=$request->keterangan;
        $dataUpdate->harga =$request->harga;
        $dataUpdate->max_penumpang=$request->max_penumpang;

        $dataUpdate->save();
        return redirect()->back()->with('success','Data berhasil diupdate!');
    }

//Delete Golongan
    public function deleteGolongan($id){
        $deleteGolongan=\App\Golongan::find($id);
        $deleteGolongan->delete();

        return redirect()->back()->with('info','Data berhasil di hapus!');
    }
}
