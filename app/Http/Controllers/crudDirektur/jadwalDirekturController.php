<?php

namespace App\Http\Controllers\crudDirektur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoftDeletes;

class jadwalDirekturController extends Controller
{
    //View Jadwal
    public function index(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');
        $dataJadwal=\App\Jadwal::whereIn('id_kapal', $hakAkses)->pluck('id');
        $jadwal = \App\detailJadwal::whereIn('id_jadwal',$dataJadwal)->with('relasiJadwal')->get();
        $pelabuhan=\App\Pelabuhan::all();
        $pelabuhanasal=\App\Pelabuhan::with('asal')->get();
        $pelabuhantujuan=\App\Pelabuhan::with('tujuan')->get();


        return view('pageDirektur.jadwalView', compact('jadwal', 'pelabuhan', 'pelabuhanasal', 'pelabuhantujuan'));

    }

    //Form Jadwal
    public function create(){
        $kapal=\App\hakAksesKapal::where('id_user', Auth::user()->id)->where('hak_akses','admin')->pluck('id_kapal');
        $dataKapal=\App\Kapal::whereIn('id', $kapal)->get();
        $pelabuhanasal=\App\Pelabuhan::with('asal')->get();
        $pelabuhantujuan=\App\Pelabuhan::with('tujuan')->get();
        return view('pageDirektur.createJadwal', compact('pelabuhanasal','pelabuhantujuan','dataKapal'));
    }

    //Create Jadwal
    public function addJadwal(Request $request){
        $jadwal = new \App\Jadwal();

        $jadwal->waktu_berangkat = $request->waktu_berangkat;
        $jadwal->estimasi_waktu = $request->estimasi_waktu;
        $jadwal->id_kapal = $request->id_kapal;
        $jadwal->id_asal_pelabuhan = $request->id_asal_pelabuhan;
        $jadwal->id_tujuan_pelabuhan = $request->id_tujuan_pelabuhan;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->harga = $request->harga;
        $jadwal->save();
        return redirect('/Direktur/Jadwal');
    }


    //Update Jadwal
    public function editJadwal(Request $request){
        $dataUpdate=\App\Jadwal::find($request->id_jadwal);

        $dataUpdate->waktu_berangkat=$request->waktu_berangkat;
        $dataUpdate->id_asal_pelabuhan=$request->id_asal_pelabuhan;
        $dataUpdate->estimasi_waktu=$request->estimasi_waktu;
        $dataUpdate->id_tujuan_pelabuhan =$request->id_tujuan_pelabuhan;
        $dataUpdate->harga=$request->harga;
        $dataUpdate->tanggal = $request->tanggal;

        $dataUpdate->save();
        return redirect('/Direktur/Jadwal');
    }

    //Delete Jadwal
    public function deleteJadwal($id){
        $deleteItem = \App\Jadwal::find($id);
        $deleteItem->delete();
        return redirect('/Direktur/Jadwal')->with('success','Berita berhasil dihapus!');
    }
}
