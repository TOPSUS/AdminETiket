<?php

namespace App\Http\Controllers\PAdmin;

use App\Golongan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class pelabuhanController extends Controller
{
//
    public function view()
    {
        $user_id = Auth::user()->id;
        $dataHakAkses = \App\hakAksesPelabuhan::where('id_user', $user_id)->where('hak_akses', 'PAdmin')->pluck('id_pelabuhan');
        $dataPelabuhan = \App\Pelabuhan::whereIn('id', $dataHakAkses)->get();
        return view('PAdmin.Pelabuhan', compact('dataPelabuhan', 'user_id'));
    }

//Form Create Pelabuhan
    public function createpelabuhan()
    {
        return view('PAdmin.createPelabuhan');
    }

//Pelabuhan
    public function viewKapal($id)
    {
        $dataAnggota = \App\anggotaPelabuhan::where('id_pelabuhan', $id)->pluck('id_kapal');
        $dataKapal = \App\Kapal::whereIn('id', $dataAnggota)->get();
        return view('PAdmin.Kapal', compact('dataKapal'));
    }

//Create Pelabuhan
    public function addPelabuhan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kode_pelabuhan' => 'required',
            'nama_pelabuhan' => 'required',
            'lokasi_pelabuhan' => 'required',
            'alamat_kantor' => 'required',
            'lama_beroperasi' => 'required',
            'status' => 'required',
            'tipe_pelabuhan' => 'required',
            'file' => 'required|file|image',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/kapal_image', $file);
            $dataPelabuhan = \App\Pelabuhan::create([
                'kode_pelabuhan' => $request->kode_pelabuhan,
                'nama_pelabuhan' => $request->nama_pelabuhan,
                'lokasi_pelabuhan' => $request->lokasi_pelabuhan,
                'alamat_kantor' => $request->alamat_kantor,
                'foto' => basename($stored),
                'lama_beroperasi' => $request->lama_beroperasi,
                'status' => $request->status,
                'tipe_pelabuhan' => $request->tipe_pelabuhan,
            ]);

            \App\hakAksesPelabuhan::create([
                'id_user' => Auth::user()->id,
                'id_pelabuhan' => $dataPelabuhan->id,
                'hak_akses' => 'PAdmin',
            ]);

            Golongan::create([
                'id_pelabuhan' => $dataPelabuhan->id,
                'golongan' => 'golongan penumpang',
                'keterangan' => 'Golongan untuk penumpang',
                'max_penumpang' => 10,
            ]);
            return redirect('AdminPelabuhan/Pelabuhan/View/' . $request->id_padmin)->with('success', 'Data Berhasil ditambahkan');
        } else {
            $dataPelabuhan = \App\Pelabuhan::create([
                'kode_pelabuhan' => $request->kode_pelabuhan,
                'nama_pelabuhan' => $request->nama_pelabuhan,
                'lokasi_pelabuhan' => $request->lokasi_pelabuhan,
                'alamat_kantor' => $request->alamat_kantor,
                'foto' => basename($stored),
                'lama_beroperasi' => $request->lama_beroperasi,
                'status' => $request->status,
                'tipe_pelabuhan' => $request->tipe_pelabuhan,
            ]);

            \App\hakAksesPelabuhan::create([
                'id_user' => Auth::user()->id,
                'id_pelabuhan' => $dataPelabuhan->id,
                'hak_akses' => 'PAdmin',
            ]);
            return redirect('AdminPelabuhan/Pelabuhan/View/' . $request->id_padmin)->with('success', 'Data Berhasil ditambahkan');
        }

    }

//Update Pelabuhan
    public function updatePelabuhan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelabuhan' => 'required',
            'lokasi_pelabuhan' => 'required',
            'alamat_kantor' => 'required',
            'lama_beroperasi' => 'required',
            'status' => 'required',
            'tipe_pelabuhan' => 'required',
            'file' => 'required|file|image',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataUpdate = \App\Pelabuhan::find($request->id_pelabuhan);

        if ($dataUpdate) {
            if ($request->hasfile('file')) {
                $file = $request->file('file');
                $file_name = time() . "_" . $file->getClientOriginalName();
                $stored = Storage::disk('admin')->putFile('/image_pelabuhan', $file);
                $dataUpdate->nama_pelabuhan = $request->nama_pelabuhan;
                $dataUpdate->lokasi_pelabuhan = $request->lokasi_pelabuhan;
                $dataUpdate->alamat_kantor = $request->alamat_kantor;
                $dataUpdate->foto = basename($stored);
                $dataUpdate->lama_beroperasi = $request->lama_beroperasi;
                $dataUpdate->status = $request->status;
                $dataUpdate->tipe_pelabuhan = $request->tipe_pelabuhan;
                $dataUpdate->save();
                return redirect()->back()->with('success', 'Data berhasil diupdate!');;
            } else {
                $dataUpdate->nama_pelabuhan = $request->nama_pelabuhan;
                $dataUpdate->lokasi_pelabuhan = $request->lokasi_pelabuhan;
                $dataUpdate->alamat_kantor = $request->alamat_kantor;
                $dataUpdate->lama_beroperasi = $request->lama_beroperasi;
                $dataUpdate->status = $request->status;
                $dataUpdate->tipe_pelabuhan = $request->tipe_pelabuhan;
                $dataUpdate->save();
                return redirect()->back()->with('success', 'Data berhasil diupdate!');;
            }
        }
    }

//Delete Pelabuhan
    public function deletePelabuhan($id)
    {
        $deletePelabuhan = \App\Pelabuhan::find($id);
        $deleteHakAkses = \App\hakAksesPelabuhan::where('id_pelabuhan', $deletePelabuhan->id)->first();
        $deleteHakAkses->delete();
        $deletePelabuhan->delete();

        return redirect()->back()->with('info', 'Data berhasil hapus!');


    }

}
