<?php

namespace App\Http\Controllers\crudDirektur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reportController extends Controller
{
    public function index(){
        return view('pageDirektur.reportKapal');
    }
    
    public function fetchData(Request $request){
        $IdDirektur=Auth::user()->id;
        $dataDirektur=\App\User::find($IdDirektur);
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdDirektur)->pluck('id_kapal');
        $idKapal=\App\Kapal::whereIn('id',$hakAkses)->pluck('id');

        if($request->fromDate != '' & $request->toDate != '' ){
            $jadwal = \App\Jadwal::whereIn('id_kapal', $idKapal)->pluck('id');
            $dataPembelian=\App\Pembelian::whereBetween('tanggal', array($request->fromDate, $request->toDate))->whereIn('id_jadwal', $jadwal)->get(['id', 'id_user', 'id_jadwal', 'tanggal']);
            foreach($dataPembelian as $index => $pembelian){
                $jadwal = $pembelian->getJadwal();
                $asal = $jadwal->getAsal()->nama_pelabuhan;
                $tujuan = $jadwal->getTujuan()->nama_pelabuhan;
                $kapal = $jadwal->getKapal()->nama_kapal;
                $newtime = strtotime($pembelian->tanggal);
                $newkeberangkatan = strtotime($pembelian->getJadwal()->waktu_berangkat);
                $newkeberangkatan = date('H:i', $newkeberangkatan);

                $dataPembelian[$index]->nama_pembeli = $pembelian->getUser()->nama;
                $dataPembelian[$index]->keberangkatan = $newkeberangkatan;
                $dataPembelian[$index]->asal = $asal;
                $dataPembelian[$index]->tujuan = $tujuan;
                $dataPembelian[$index]->kapal = $kapal;
                $dataPembelian[$index]->tanggal_pembelian = date('Y-m-d',$newtime);;
                
            }
        }
        $pdf = PDF::loadview('pageDirektur.report_pdf',['dataPembelian'=>$dataPembelian]);
        return $pdf->download('laporan-transaksi.pdf');
    }

    public function cetakPDF(Request $request){
        $IdDirektur=Auth::user()->id;
        $dataDirektur=\App\User::find($IdDirektur);
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdDirektur)->pluck('id_kapal');
        $idKapal=\App\Kapal::whereIn('id',$hakAkses)->pluck('id');
        if($request->fromDate != '' & $request->toDate != '' ){
            $jadwal = \App\Jadwal::whereIn('id_kapal', $idKapal)->pluck('id');
            $dataPembelian=\App\Pembelian::whereBetween('tanggal', array($request->fromDate, $request->toDate))->whereIn('id_jadwal', $jadwal)->with('user','jadwal')->get();
        }
        
        $pdf = \PDF::loadview('pageDirektur.report_pdf',compact('dataPembelian'));
        return $pdf->stream();
    }
}
