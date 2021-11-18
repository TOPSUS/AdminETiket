<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class jadwalController extends Controller
{

//View Jadwal
    public function view($hari)
    {
        $dataJadwal = \App\Jadwal::all()->pluck('id');
        $detailJadwal = \App\detailJadwal::whereIn('id_jadwal', $dataJadwal)->where('hari', $hari)->where('status', 'aktif')->with('relasiJadwal')->get();

        return view('Crud.jadwalView', compact('detailJadwal'));
    }

//View Jadwal
    public function viewMaster()
    {
        $dataJadwal = \App\Jadwal::with('asal', 'tujuan', 'kapal')->get();
        $detailJadwal = \App\detailJadwal::with('relasiJadwal')->get();

        return view('Crud.masterJadwal', compact('dataJadwal'));
    }

//Form Create
    public function create()
    {
        //Menampilkan data di form
        $kapal = \App\Kapal::all();
        $pelabuhan = \App\Pelabuhan::all();

        return view('Crud.createJadwal', compact('kapal', 'pelabuhan'));
    }

    //Form Create Detail Jadwal
    public function createdetail()
    {
        $dataJadwal = \App\Jadwal::with('asal', 'tujuan', 'kapal')->get();
        return view('Crud.createDetailJadwal', compact('dataJadwal'));
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
                'status' => 'aktif',
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
            ]);

            \App\Jadwal::create([
                'waktu_berangkat' => $request->waktu_kembali,
                'id_asal_pelabuhan' => $request->id_tujuan_pelabuhan,
                'estimasi_waktu' => $request->estimasi_waktu,
                'id_tujuan_pelabuhan' => $request->id_asal_pelabuhan,
                'id_kapal' => $request->id_kapal,
            ]);

            return redirect(route('master-jadwal-sa'))->with('success', 'Data berhasil ditambahkan!!');
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
