<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class jadwalController extends Controller
{

//View Jadwal
    public function view(){
        $dataJadwal=\App\Jadwal::with('kapal','asal','tujuan')->get();
        $speedboat=\App\Kapal::all();
        $pelabuhan=\App\Pelabuhan::all();
    	return view('Crud.jadwalView', compact('dataJadwal','speedboat','pelabuhan'));
    }

//Form Create
    public function create(){
        //Menampilkan data di form 
        $speedboat=\App\Kapal::all();
        $pelabuhan=\App\Pelabuhan::all();

    	return view('Crud.createJadwal', compact('speedboat','pelabuhan'));
    }

//Create Jadwal
    public function addJadwal(Request $request)
    {
        $data = $request->daterange;
        $period = explode(' - ',$data);
        $date1 = \Carbon\Carbon::parse($period[0])->format('Y-m-d');
        $date2 = \Carbon\Carbon::parse($period[1])->format('Y-m-d');
        $period = \Carbon\CarbonPeriod::create($date1,$date2);
        foreach ($period as $pd){
            \App\Jadwal::create([
                'waktu_berangkat'=>$request->waktu_berangkat,
                'id_asal_pelabuhan'=>$request->id_asal_pelabuhan,
                'waktu_sampai'=>$request->waktu_sampai,
                'id_tujuan_pelabuhan'=>$request->id_tujuan_pelabuhan,
                'id_kapal'=>$request->id_kapal,
                'tanggal'=>$pd->toDateString(),
                'harga'=>$request->harga,
            ]);
        }
        return redirect('/Dashboard/CRUD/JadwalData');

    }

//Update Jadwal
    public function updateJadwal(Request $request){
        $dataUpdate=\App\Jadwal::find($request->id_jadwal);

        $dataUpdate->waktu_berangkat=$request->waktu_berangkat;
        $dataUpdate->id_asal_pelabuhan=$request->id_asal_pelabuhan;
        $dataUpdate->waktu_sampai=$request->waktu_sampai;
        $dataUpdate->id_tujuan_pelabuhan =$request->id_tujuan_pelabuhan;
        $dataUpdate->id_kapal =$request->id_kapal;
        $dataUpdate->harga=$request->harga;

        $dataUpdate->save();
        return redirect()->back();
    }

//Delete User
    public function deleteJadwal($id){
        $deleteJadwal=\App\Jadwal::find($id);
        $deleteJadwal->delete();

        return redirect()->back();
    }


}
