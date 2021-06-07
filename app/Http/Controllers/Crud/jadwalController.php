<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class jadwalController extends Controller
{

//View Jadwal
    public function view($hari){
        $dataJadwal=\App\Jadwal::all()->pluck('id');
        $detailJadwal=\App\detailJadwal::whereIn('id_jadwal',$dataJadwal)->where('hari',$hari)->where('status','aktif')->with('relasiJadwal')->get();
        
        return view('Crud.jadwalView', compact('detailJadwal'));
    }

//View Jadwal
    public function viewMaster(){
    $dataJadwal=\App\Jadwal::with('asal','tujuan','kapal')->get();
    $detailJadwal=\App\detailJadwal::with('relasiJadwal')->get();

    return view('Crud.masterJadwal', compact('dataJadwal'));
    }

//Form Create
    public function create(){
        //Menampilkan data di form
        $kapal=\App\Kapal::all();
        $pelabuhan=\App\Pelabuhan::all();

        return view('Crud.createJadwal', compact('kapal','pelabuhan'));
    }

//Form Create Detail Jadwal
    public function createdetail(){
    //Menampilkan data di form
    $hakAkses=\App\hakAksesPelabuhan::where('id_user', Auth::user()->id)->pluck('id_pelabuhan');
    $dataJadwal=\App\Jadwal::with('asal','tujuan','kapal')->whereIn('id_asal_pelabuhan',$hakAkses)->get();

    return view('Crud.createDetailJadwal', compact('dataJadwal'));
    }

//Create Jadwal
    public function addJadwal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'daterange' => 'required',
            'waktu_berangkat'=>'required',
            'id_asal_pelabuhan'=>'required',
            'estimasi_waktu'=>'required|numeric',
            'id_tujuan_pelabuhan'=>'required',
            'id_kapal'=>'required',
            'harga'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->daterange;
        $period = explode(' - ',$data);
        $date1 = \Carbon\Carbon::parse($period[0])->format('Y-m-d');
        $date2 = \Carbon\Carbon::parse($period[1])->format('Y-m-d');
        $period = \Carbon\CarbonPeriod::create($date1,$date2);
        foreach ($period as $pd){
            \App\Jadwal::create([
                'waktu_berangkat'=>$request->waktu_berangkat,
                'id_asal_pelabuhan'=>$request->id_asal_pelabuhan,
                'estimasi_waktu'=>$request->estimasi_waktu,
                'id_tujuan_pelabuhan'=>$request->id_tujuan_pelabuhan,
                'id_kapal'=>$request->id_kapal,
                'tanggal'=>$pd->toDateString(),
                'harga'=>$request->harga,
            ]);
        }
        return redirect('/Dashboard/CRUD/JadwalData')->with('success','Data berhasil ditambahkan!!');

    }

//Update Jadwal
    public function updateJadwal(Request $request){

        $validator = Validator::make($request->all(), [
            'waktu_berangkat'=>'required',
            'id_asal_pelabuhan'=>'required',
            'estimasi_waktu'=>'required|numeric',
            'id_tujuan_pelabuhan'=>'required',
            'id_kapal'=>'required',
            'harga'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataUpdate=\App\Jadwal::find($request->id_jadwal);

        $dataUpdate->waktu_berangkat=$request->waktu_berangkat;
        $dataUpdate->id_asal_pelabuhan=$request->id_asal_pelabuhan;
        $dataUpdate->estimasi_waktu=$request->estimasi_waktu;
        $dataUpdate->id_tujuan_pelabuhan =$request->id_tujuan_pelabuhan;
        $dataUpdate->id_kapal =$request->id_kapal;
        $dataUpdate->harga=$request->harga;
        $dataUpdate->save();
        return redirect()->back()->with('success','Data berhasil diupdate!');
    }

//Delete Jadwal
    public function deleteJadwal($id){
        $deleteJadwal=\App\Jadwal::find($id);
        $deleteJadwal->delete();

        return redirect()->back()->with('info','Data berhasil dihapus!');
    }


}
