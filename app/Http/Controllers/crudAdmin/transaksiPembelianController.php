<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class transaksiPembelianController extends Controller
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

    	return view('pageAdminSpeedboat.transaksiPembelianAdmin', compact('dataPembelian'));
    }
    //View Detail
    public function detail($id){
        $IdAdmin=Auth::user()->id;
        $IdSpeedboat=\App\User::find(Auth::user()->id);
    	$dataPembelian=\App\Pembelian::with('user','jadwal','detailPembelian')->where('id',$id)->first();
        $detailPembelian=\App\detailPembelian::where('id_pembelian',$dataPembelian->id)->get();
        $jumlah=0; 
        foreach($detailPembelian as $dp){
            $jumlah=$jumlah+$dp->harga;
        }
        return view('pageAdminSpeedboat.detailTransaksiPembelian', compact('dataPembelian','jumlah'));

    }

//Update Status
    //approve
    public function approve($id){
        $pembelian=\App\Pembelian::where('id',$id)->first();
        $pembelian->status='Terkonfirmasi';
        $pembelian->save();

        return redirect()->back();
    }

    //reject
    public function reject($id){
        $pembelian=\App\Pembelian::where('id',$id)->first();
        $pembelian->status='Dibatalkan';
        $pembelian->save();

        return redirect()->back();
    }
}
