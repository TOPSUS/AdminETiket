<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class transaksiPembelianController extends Controller
{
    //
    public function index(){
        $dataPembelian=\App\Pembelian::with('user','jadwal')->get();
    	return view('pageAdminSpeedboat.transaksiPembelianAdmin', compact('dataPembelian'));
    }
    //View Detail
    public function detail($id){
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

        return redirect('DetailTransaksi');
    }

    //reject
    public function reject($id){
        $pembelian=\App\Pembelian::where('id',$id)->first();
        $pembelian->status='Dibatalkan';
        $pembelian->save();

        return redirect('DetailTransaksi');
    }
}
