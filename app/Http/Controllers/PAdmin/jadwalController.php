<?php

namespace App\Http\Controllers\PAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class jadwalController extends Controller
{

//View Jadwal
    public function view($hari)
    {
        $hakAkses = \App\hakAksesPelabuhan::where('id_user', Auth::user()->id)->pluck('id_pelabuhan');
        $dataJadwal = \App\Jadwal::whereIn('id_asal_pelabuhan', $hakAkses)->pluck('id');
        $detailJadwal = \App\detailJadwal::whereIn('id_jadwal', $dataJadwal)->where('hari', $hari)->with('relasiJadwal')->get();

        return view('PAdmin.jadwalView', compact('detailJadwal'));
    }

//View Jadwal
    public function viewMaster()
    {
        $hakPelabuhan = \App\hakAksesPelabuhan::where('id_user', Auth::user()->id)->pluck('id_pelabuhan');
        $pelabuhan = \App\Pelabuhan::whereIn('id', $hakPelabuhan)->get();
        $hakAkses = \App\hakAksesPelabuhan::where('id_user', Auth::user()->id)->pluck('id_pelabuhan');
        $dataJadwal = \App\Jadwal::with('asal', 'tujuan', 'kapal')->whereIn('id_asal_pelabuhan', $hakAkses)->get();
        $detailJadwal = \App\detailJadwal::with('relasiJadwal')->get();

        return view('PAdmin.masterJadwal', compact('dataJadwal', 'pelabuhan'));
    }

//Form Create
    public function create()
    {
        //Menampilkan data di form
        $hakPelabuhan = \App\hakAksesPelabuhan::where('id_user', Auth::user()->id)->pluck('id_pelabuhan');
        $anggotaPelabuhan = \App\anggotaPelabuhan::whereIn('id_pelabuhan', $hakPelabuhan)->where('status', 'approve')->pluck('id_kapal');
        $pelabuhan = \App\Pelabuhan::whereIn('id', $hakPelabuhan)->get();
        $kapal = \App\Kapal::whereIn('id', $anggotaPelabuhan)->get();

        return view('PAdmin.createJadwal', compact('kapal', 'pelabuhan'));
    }

    public function ajaxList($id)
    {
        $anggotaPelabuhan = \App\anggotaPelabuhan::where('id_pelabuhan', $id)->where('status', 'approve')->pluck('id_kapal');
        $kapal = \App\Kapal::whereIn('id', $anggotaPelabuhan)->get();

        return response()->json($kapal, 200);
    }

    public function ajaxTurnOn(Request $request){
        $dataJadwal = \App\detailJadwal::find($request->id);
        if($dataJadwal){
            $dataJadwal->status='aktif';
            $dataJadwal->save();
            return response()->json(['message'=>'success'],200);
        }
        return response()->json(['message'=>'data not found'],401);
    }

    public function ajaxTurnOff(Request $request){
        $dataJadwal = \App\detailJadwal::find($request->id);
        if($dataJadwal){
            $dataJadwal->status='nonaktif';
            $dataJadwal->save();
            return response()->json(['message'=>'success'],200);
        }
        return response()->json(['message'=>'data not found'],401);
    }

//Form Create Detail Jadwal
    public function createdetail()
    {
        //Menampilkan data di form
        $hakAkses = \App\hakAksesPelabuhan::where('id_user', Auth::user()->id)->pluck('id_pelabuhan');
        $dataJadwal = \App\Jadwal::with('asal', 'tujuan', 'kapal')->whereIn('id_asal_pelabuhan', $hakAkses)->get();

        return view('PAdmin.createDetailJadwal', compact('dataJadwal'));
    }

//Create Jadwal Detail
    public function addJadwalDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jadwal' => 'required|numeric',
            'hari' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $check = \App\detailJadwal::where('id_jadwal', $request->id_jadwal)->where('hari', $request->hari)->first();
        if (!$check) {
            $detailJadwal = \App\detailJadwal::create([
                'id_jadwal' => $request->id_jadwal,
                'hari' => $request->hari,
                'status'=>'aktif',
            ]);
            return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
        }
        return redirect()->back()->with('info', 'Data yang ditambahkan sudah ada dalam jadwal!');
    }

//Create Jadwal
    public function addJadwal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'waktu_berangkat' => 'required',
            'waktu_kembali' => 'required',
            'id_asal_pelabuhan' => 'required',
            'estimasi_waktu' => 'required|numeric',
            'id_tujuan_pelabuhan' => 'required',
            'id_kapal' => 'required',
            'harga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->id_asal_pelabuhan != $request->id_tujuan_pelabuhan) {
            \App\Jadwal::create([
                'waktu_berangkat' => $request->waktu_berangkat,
                'id_asal_pelabuhan' => $request->id_asal_pelabuhan,
                'estimasi_waktu' => $request->estimasi_waktu,
                'id_tujuan_pelabuhan' => $request->id_tujuan_pelabuhan,
                'id_kapal' => $request->id_kapal,
                'harga' => $request->harga,
            ]);

            \App\Jadwal::create([
                'waktu_berangkat' => $request->waktu_kembali,
                'id_asal_pelabuhan' => $request->id_tujuan_pelabuhan,
                'estimasi_waktu' => $request->estimasi_waktu,
                'id_tujuan_pelabuhan' => $request->id_asal_pelabuhan,
                'id_kapal' => $request->id_kapal,
                'harga' => $request->harga,
            ]);

            return redirect(route('master-jadwal'))->with('success', 'Data berhasil ditambahkan!!');
        } else {
            return redirect()->back()->with('info', 'Asal dan tujuan tidak boleh sama');
        }
    }

//Update Jadwal
    public function updateJadwal(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'waktu_berangkat' => 'required',
            'id_asal_pelabuhan' => 'required',
            'estimasi_waktu' => 'required|numeric',
            'id_tujuan_pelabuhan' => 'required',
            'id_kapal' => 'required',
            'harga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataUpdate = \App\Jadwal::find($request->id_jadwal);

        $dataUpdate->waktu_berangkat = $request->waktu_berangkat;
        $dataUpdate->id_asal_pelabuhan = $request->id_asal_pelabuhan;
        $dataUpdate->estimasi_waktu = $request->estimasi_waktu;
        $dataUpdate->id_tujuan_pelabuhan = $request->id_tujuan_pelabuhan;
        $dataUpdate->id_kapal = $request->id_kapal;
        $dataUpdate->harga = $request->harga;
        $dataUpdate->save();
        return redirect()->back()->with('success', 'Data berhasil diupdate!');
    }

//Delete Jadwal
    public function deleteJadwal($id)
    {
        $deleteJadwal = \App\Jadwal::find($id);
        $deleteDetail = \App\detailJadwal::where('id_jadwal', $deleteJadwal->id)->get();
        foreach ($deleteDetail as $dt) {
            $dt->delete();
        }

        $deleteJadwal->delete();

        return redirect()->back()->with('info', 'Data berhasil dihapus!');
    }


}
