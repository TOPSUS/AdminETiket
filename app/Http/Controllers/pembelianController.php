<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pembelianController extends Controller
{
    //
    public function index(){
        $dataPembelian=\App\Pembelian::with('user','jadwal')->get();
    	return view('Page.approvePembelianView', compact('dataPembelian'));
    }
    //View Detail
    public function detail($id){
    	$dataPembelian=\App\Pembelian::with('user','jadwal','detailPembelian')->where('id',$id)->first();
        $detailPembelian=\App\detailPembelian::where('id_pembelian',$dataPembelian->id)->get();
        $jumlah=0; 
        foreach($detailPembelian as $dp){
            $jumlah=$jumlah+$dp->harga;
        }
        return view('Page.detailPembelian', compact('dataPembelian','jumlah'));

    }

//Update Status
    //approve
    public function approve($id){
        $pembelian=\App\Pembelian::where('id',$id)->first();
        $pembelian->status='Terkonfirmasi';
        $pembelian->save();

        return redirect('Dashboard/Pembelian');
    }

    //reject
    public function reject($id){
        $pembelian=\App\Pembelian::where('id',$id)->first();
        $pembelian->status='Dibatalkan';
        $pembelian->save();

        return redirect('Dashboard/Pembelian');
    }

    //pembelian
    public function create(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');
        $jadwal=\App\Jadwal::whereIn('id_kapal', $hakAkses)->with('asal','tujuan','kapal')->get();
        $pelabuhan=\App\Pelabuhan::all();
        
        $pelabuhanasal=\App\Pelabuhan::with('asal')->get();
        $pelabuhantujuan=\App\Pelabuhan::with('tujuan')->get();

        return view('CrudAdmin.createPembelian', compact('jadwal'));
    }

}
