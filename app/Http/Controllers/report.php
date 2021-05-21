<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class report extends Controller
{
    public function cetakPDF(Request $request){
        $IdDirektur=Auth::user()->id;
        $dataDirektur=\App\User::find($IdDirektur);
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdDirektur)->pluck('id_kapal');
        $idKapal=\App\Kapal::whereIn('id',$hakAkses)->pluck('id');
        if($request->fromDate != '' & $request->toDate != '' ){
            $jadwal = \App\Jadwal::whereIn('id_kapal', $idKapal)->pluck('id');
            $dataPembelian=\App\Pembelian::whereBetween('tanggal', array($request->fromDate, $request->toDate))->whereIn('id_jadwal', $jadwal)->with('user','jadwal')->get();
            $pdf = \PDF::loadview('pageDirektur.report_pdf',compact('dataPembelian'));
            return $pdf->stream();
        }
        return back()->with('errors','Data tidak ditemukan!');
    }
}
