<?php

namespace App\Http\Controllers\crudAdmin;

use App\anggotaPelabuhan;
use App\detailGolongan;
use App\Golongan;
use App\Http\Controllers\Controller;
use App\Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class golonganController extends Controller
{
    public function index($id)
    {
        $kapal = Kapal::find($id);
        $dataGolongan = detailGolongan::where('id_kapal', $id)->with('kapal', 'golongan')->get();
        return view('pageAdminSpeedboat.detaiGolonganView', compact('dataGolongan', 'kapal'));
    }

    public function create($id)
    {
        $anggota = anggotaPelabuhan::where('id_kapal', $id)->first();
        $golongan = Golongan::where('id_pelabuhan', $anggota->id_pelabuhan)->get();

        return view('pageAdminSpeedboat.createGolongan', compact('golongan', 'anggota'));
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_golongan'=>'required|numeric',
            'jumlah'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $detailGolongan = detailGolongan::create([
            'id_kapal'=>$request->id_kapal,
            'id_golongan'=>$request->id_golongan,
            'jumlah'=>$request->jumlah,
        ]);

        if($detailGolongan){
            return redirect('/Golongan/Kapal/'.$request->id_kapal)->with('success','Golongan berhasil ditambahkan');
        }
        return redirect()->back()->with('error','Golongan gagal ditambahkan');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $detailGolongan = detailGolongan::find($request->id);
        $detailGolongan->jumlah = $request->jumlah;
        $detailGolongan->save();

        if($detailGolongan){
            return redirect('/Golongan/Kapal/'.$request->id_kapal)->with('success','Golongan berhasil ditambahkan');
        }
        return redirect()->back()->with('error','Golongan gagal ditambahkan');
    }

    public function delete($id)
    {
        $dataDelete = detailGolongan::find($id);
        $dataDelete->delete();
        return redirect()->back()->with('success','Golongan berhasil dihapus');
    }
}
