<?php

namespace App\Http\Controllers\PAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\hakAksesPelabuhan;
use Illuminate\Support\Facades\Auth;
use App\Pelabuhan;

class dermagaController extends Controller
{

//View Dermaga
    public function index(){
        $hakAkses = hakAksesPelabuhan::where('id_user',Auth::user()->id)->pluck('id_pelabuhan');
        $pelabuhan = Pelabuhan::whereIn('id',$hakAkses)->whereIn('tipe_pelabuhan',['feri','speedboat & feri'])->get();
        $dataDermaga = \App\Dermaga::whereIn('id_pelabuhan',$hakAkses)->with('relasiPelabuhan')->get();
        return view('PAdmin.dermagaView', compact('dataDermaga','pelabuhan'));
    }

//Form Create
    public function create(){
        $hakAkses = hakAksesPelabuhan::where('id_user',Auth::user()->id)->pluck('id_pelabuhan');
        $pelabuhan = Pelabuhan::whereIn('id',$hakAkses)->whereIn('tipe_pelabuhan',['feri','speedboat & feri'])->get();

        return view('PAdmin.createDermaga', compact('pelabuhan'));
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
        return redirect('/AdminPelabuhan/Dermaga')->with('success','Data berhasil dibuat!');

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
