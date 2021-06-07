<?php

namespace App\Http\Controllers\PAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    //
    public function index(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        //Karna setiap admin memiliki banyak kapal
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');
        $idSpeedboat=\App\Kapal::whereIn('id',$hakAkses)->pluck('id');
        $dataPelabuhan = \App\hakAksesPelabuhan::where('id_user',Auth::user()->id)->pluck('id_pelabuhan');
        //$dataPembelian=\App\Pembelian::find($request->id_speedboat);
        $jadwal = \App\Jadwal::whereIn('id_asal_pelabuhan', $dataPelabuhan)->pluck('id');
        $detailJadwal = \App\detailJadwal::whereIn('id_jadwal',$jadwal)->pluck('id');
        $dataPembelian=\App\Pembelian::with('user','jadwal')->whereIn('id_jadwal', $detailJadwal)->get();

        return view('PAdmin.transaksiPembelianAdmin', compact('IdAdmin', 'dataPembelian'));
    }
    //View Detail
    public function detail($id){
        $IdAdmin=Auth::user()->id;
        $IdSpeedboat=\App\User::find($IdAdmin);
        $dataPembelian=\App\Pembelian::with('user','jadwal','detailPembelian')->where('id',$id)->first();
        $detailPembelian=\App\detailPembelian::where('id_pembelian',$dataPembelian->id)->get();
        $jumlah=0;
        foreach($detailPembelian as $dp){
            $jumlah=$jumlah+$dp->harga;
        }
        return view('PAdmin.detailTransaksiPembelian', compact('dataPembelian','jumlah'));

    }
}
