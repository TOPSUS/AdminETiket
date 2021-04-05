<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class direkturController extends Controller
{

//Speedboat Direktur
    public function speedboat($id){
        $dataHakAkses=\App\hakAksesSpeedboat::where('id_user',$id)->where('hak_akses','Direktur')->get();
        return view('Crud.direkturSpeedboat', compact('dataHakAkses'));
    }

//Form Create Speedboat
    public function createspeedboat($id){
        $id1=$id;
        return view('Crud.direkturCreateSpeedboat', compact('id1'));
    }

//Create Speedboat
    public function addSpeedboat(Request $request){
        $dataSpeedboat=\App\Speedboat::create([
            'nama_speedboat'=>$request->nama_speedboat,
            'kapasitas'=>$request->kapasitas,
            'deskripsi'=>$request->deskripsi,
            'tanggal_beroperasi'=>$request->tanggal_beroperasi,
            'foto'=>$request->foto,
            'contact_service'=>$request->contact_service,
        ]);

        \App\hakAksesSpeedboat::create([
            'id_user'=>$request->id_direktur,
            'id_speedboat'=>$dataSpeedboat->id,
            'hak_akses'=>'Direktur',
        ]);
        return redirect('/Dashboard/CRUD/DirekturData/Speedboat/'.$request->id_direktur);
    }

//Kapal Direktur
    public function kapal($id){
        $dataHakAkses=\App\hakAksesKapal::where('id_user',$id)->where('hak_akses','Direktur')->get();
        return view('Crud.direkturKapal', compact('dataHakAkses'));
    }

//Form Create Kapal
    public function createkapal($id){
        $id1=$id;
        return view('Crud.direkturCreateKapal', compact('id1'));
    }

//Create Kapal
    public function addKapal(Request $request){
        $dataKapal=\App\Kapal::create([
            'nama_kapal'=>$request->nama_kapal,
            'deskripsi'=>$request->deskripsi,
            'foto'=>$request->foto,
            'tanggal_beroperasi'=>$request->tanggal_beroperasi,
        ]);

        \App\hakAksesKapal::create([
            'id_user'=>$request->id_direktur,
            'id_kapal'=>$dataKapal->id,
            'hak_akses'=>'Direktur',
        ]);
        return redirect('/Dashboard/CRUD/DirekturData/Kapal/'.$request->id_direktur);
    }

}
