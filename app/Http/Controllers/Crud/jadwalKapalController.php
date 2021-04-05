<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class jadwalKapalController extends Controller
{
//View Jadwal Kapal
    public function view(){
        $dataJadwalKapal=\App\jadwalKapal::with('kapal','asal','tujuan')->get();
        $kapal=\App\Kapal::all();
        $pelabuhan=\App\Pelabuhan::all();
    	return view('Crud.jadwalKapalView', compact('dataJadwalKapal','kapal','pelabuhan'));
    }

//Form Create Kapal
    public function create(){
        //Menampilkan data di form 
        $kapal=\App\Kapal::all();
        $pelabuhan=\App\Pelabuhan::all();

        return view('Crud.createJadwalKapal', compact('kapal','pelabuhan'));
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
    return redirect('/Dashboard/CRUD/JadwalKapalData');

}
}
