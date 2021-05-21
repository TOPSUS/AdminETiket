<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminSpeedboat extends Controller
{
    //
    public function index(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);

        //Karna setiap admin memiliki banyak kapal
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');
        $idSpeedboat=\App\Kapal::whereIn('id',$hakAkses)->pluck('id');



        //$dataPembelian=\App\Pembelian::find($request->id_speedboat);
        $jadwal = \App\Jadwal::whereIn('id_kapal', $idSpeedboat)->pluck('id');
        $dataPembelian=\App\Pembelian::with('user','jadwal')->whereIn('id_jadwal', $jadwal)->get();

        $asal = Jadwal::whereIn('id_kapal',$hakAkses)->pluck('id_asal_pelabuhan')->count();
        $lifetimetransaksi = $dataPembelian->count();
        $jumlahKapal = $hakAkses->count();
    	return view('adminSpeedboat.homeAdmin', compact('dataPembelian', 'asal','lifetimetransaksi','jumlahKapal'));
    }

}
