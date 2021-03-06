<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SoftDeletes;

class jadwalController extends Controller
{
    //View Jadwal
    public function index(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');
        $jadwal=\App\Jadwal::whereIn('id_kapal', $hakAkses)->with('asal','tujuan','kapal')->get();
        $pelabuhan=\App\Pelabuhan::all();

        $pelabuhanasal=\App\Pelabuhan::with('asal')->get();
        $pelabuhantujuan=\App\Pelabuhan::with('tujuan')->get();

        return view('pageAdminSpeedboat.jadwalView', compact('jadwal', 'pelabuhan', 'pelabuhanasal', 'pelabuhantujuan'));

    }

    //Form Jadwal
    public function create(){
        $kapal=\App\hakAksesKapal::where('id_user', Auth::user()->id)->where('hak_akses','admin')->pluck('id_kapal');
        $dataKapal=\App\Kapal::whereIn('id', $kapal)->get();
        $pelabuhanasal=\App\Pelabuhan::with('asal')->get();
        $pelabuhantujuan=\App\Pelabuhan::with('tujuan')->get();
        return view('CrudAdmin.createJadwal', compact('pelabuhanasal','pelabuhantujuan','dataKapal'));
    }

    //Create Jadwal
    public function addJadwal(Request $request){

        $validator = Validator::make($request->all(), [
            'waktu_berangkat'=>'required',
            'estimasi_waktu'=>'required|numeric',
            'id_kapal'=>'required|numeric',
            'id_asal_pelabuhan'=>'required|numeric',
            'id_tujuan_pelabuhan'=>'required|numeric',
            'tanggal'=>'required|date',
            'harga'=>'required|numeric'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $jadwal = new \App\Jadwal();

        $jadwal->waktu_berangkat = $request->waktu_berangkat;
        $jadwal->estimasi_waktu = $request->estimasi_waktu;
        $jadwal->id_kapal = $request->id_kapal;
        $jadwal->id_asal_pelabuhan = $request->id_asal_pelabuhan;
        $jadwal->id_tujuan_pelabuhan = $request->id_tujuan_pelabuhan;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->harga = $request->harga;
        $jadwal->save();
        if($jadwal){
            return redirect('/Jadwal')->with('success','Data berhasil ditambahkan!');
        }
        return redirect('/Jadwal')->with('errors','Ooops, sepertinya terjadi kesalahan, data tidak tersimpan!');

    }


    //Update Jadwal
    public function editJadwal(Request $request){

        $validator = Validator::make($request->all(), [
            'waktu_berangkat'=>'required',
            'estimasi_waktu'=>'required|numeric',
            'id_asal_pelabuhan'=>'required|numeric',
            'id_tujuan_pelabuhan'=>'required|numeric',
            'tanggal'=>'required|date',
            'harga'=>'required|numeric'
        ]);

        $dataUpdate=\App\Jadwal::find($request->id_jadwal);
        if($dataUpdate){
            $dataUpdate->waktu_berangkat=$request->waktu_berangkat;
            $dataUpdate->id_asal_pelabuhan=$request->id_asal_pelabuhan;
            $dataUpdate->estimasi_waktu=$request->estimasi_waktu;
            $dataUpdate->id_tujuan_pelabuhan =$request->id_tujuan_pelabuhan;
            $dataUpdate->harga=$request->harga;
            $dataUpdate->tanggal = $request->tanggal;
            $dataUpdate->save();
            return redirect('/Jadwal')->with('success','Data berhasil di update');
        }
        return redirect('/Jadwal')->with('errors','Data tidak ditemukan!');

    }

    //Delete Jadwal
    public function deleteJadwalSpeedboat($id){
        $deleteItem = \App\Jadwal::find($id);
        $deleteItem->delete();
        return redirect('/Jadwal')->with('info','Berita berhasil dihapus!');
    }


}
