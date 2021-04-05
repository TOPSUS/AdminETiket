<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoftDeletes;

class jadwalController extends Controller
{
    //View Jadwal
    public function index(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $hakAkses=\App\hakAksesSpeedboat::where('id_user', $IdAdmin)->first();
        $profile=\App\Speedboat::find($hakAkses->id_speedboat);
        $jadwal=\App\Jadwal::where('id_speedboat', $profile->id)->with('asal','tujuan')->get();
        $pelabuhan=\App\Pelabuhan::all();
        
        $pelabuhanasal=\App\Pelabuhan::with('asal')->get();
        $pelabuhantujuan=\App\Pelabuhan::with('tujuan')->get();
        $speedboat = \App\Speedboat::with('relasiJadwal')->get();

        return view('pageAdminSpeedboat.jadwalView', compact('jadwal', 'pelabuhan', 'pelabuhanasal', 'pelabuhantujuan', 'speedboat'));

    }

    //Form Jadwal
    public function create(){
        $pelabuhanasal=\App\Pelabuhan::with('asal')->get();
        $pelabuhantujuan=\App\Pelabuhan::with('tujuan')->get();
        return view('CrudAdmin.createJadwal', compact('pelabuhanasal','pelabuhantujuan'));
    }

    //Create Jadwal
    public function addJadwal(Request $request){
        $IdSpeedboat=Auth::user()->id_speedboat;
        $jadwal = new \App\Jadwal();

        $jadwal->waktu_berangkat = $request->waktu_berangkat;
        $jadwal->waktu_sampai = $request->waktu_sampai;
        $jadwal->id_speedboat = $IdSpeedboat;
        $jadwal->id_asal_pelabuhan = $request->id_asal_pelabuhan;
        $jadwal->id_tujuan_pelabuhan = $request->id_tujuan_pelabuhan;
        $jadwal->harga = $request->harga;
        $jadwal->save();
        return redirect('/Jadwal');
    }


    //Update Jadwal
    public function editJadwal(Request $request){
        $IdSpeedboat=Auth::user()->id_speedboat;
        $dataUpdate=\App\Jadwal::find($request->id_jadwal);

        $dataUpdate->waktu_berangkat=$request->waktu_berangkat;
        $dataUpdate->id_asal_pelabuhan=$request->id_asal_pelabuhan;
        $dataUpdate->waktu_sampai=$request->waktu_sampai;
        $dataUpdate->id_tujuan_pelabuhan =$request->id_tujuan_pelabuhan;
        $dataUpdate->id_speedboat = $IdSpeedboat;
        $dataUpdate->harga=$request->harga;

        $dataUpdate->save();
        return redirect('/Jadwal');
    }

    //Delete Jadwal
    public function deleteJadwalSpeedboat($id){
        $deleteItem = \App\Jadwal::find($id);
        $deleteItem->delete();
        return redirect('/Jadwal')->with('success','Berita berhasil dihapus!');
    }

    
}
