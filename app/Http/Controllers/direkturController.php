<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class direkturController extends Controller
{

//Speedboat Direktur
    public function speedboat($id){
        $user_id = $id;
        $dataHakAkses=\App\hakAksesKapal::where('id_user',$id)->where('hak_akses','Direktur')->pluck('id_kapal');
        $dataKapal = \App\Kapal::whereIn('id',$dataHakAkses)->get();
        return view('Crud.direkturSpeedboat', compact('dataKapal','user_id'));
    }

//Form Create Speedboat
    public function createspeedboat($id){
        $id1=$id;
        $dataPelabuhan=\App\Pelabuhan::whereIn('tipe_pelabuhan',['speedboat','speedboat & feri'])->get();
        return view('Crud.direkturCreateSpeedboat', compact('id1','dataPelabuhan'));
    }

//Create Speedboat
    public function addSpeedboat(Request $request){

        $validator = Validator::make($request->all(), [
            'nama_kapal'=>'required',
            'kapasitas'=>'required|numeric|min:0',
            'deskripsi'=>'required',
            'tanggal_beroperasi'=>'required',
            'file'=>'required|file|image',
            'contact_service'=>'required|numeric',
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
            $dataSpeedboat=\App\Kapal::create([
                'nama_kapal'=>$request->nama_kapal,
                'kapasitas'=>$request->kapasitas,
                'deskripsi'=>$request->deskripsi,
                'tanggal_beroperasi'=>$request->tanggal_beroperasi,
                'foto'=>basename($stored),
                'tipe_kapal'=>'speedboat',
                'contact_service'=>$request->contact_service,
            ]);

            \App\hakAksesKapal::create([
                'id_user'=>$request->id_direktur,
                'id_kapal'=>$dataSpeedboat->id,
                'hak_akses'=>'Direktur',
            ]);

            $anggotaPelabuhan= \App\anggotaPelabuhan::create([
                'id_kapal'=>$dataSpeedboat->id,
                'id_pelabuhan'=>$request->id_pelabuhan,
                'status'=>'pending',
            ]);
            return redirect('/Dashboard/CRUD/DirekturData/Speedboat/View/'.$request->id_direktur)->with('success','Data Berhasil Ditambahkan!');
        } else {
            $dataSpeedboat=\App\Kapal::create([
                'nama_kapal'=>$request->nama_kapal,
                'kapasitas'=>$request->kapasitas,
                'deskripsi'=>$request->deskripsi,
                'tanggal_beroperasi'=>$request->tanggal_beroperasi,
                'contact_service'=>$request->contact_service,
            ]);

            \App\hakAksesKapal::create([
                'id_user'=>$request->id_direktur,
                'id_kapal'=>$dataSpeedboat->id,
                'hak_akses'=>'Direktur',
            ]);

            $anggotaPelabuhan= \App\anggotaPelabuhan::create([
                'id_kapal'=>$dataSpeedboat->id,
                'id_pelabuhan'=>$request->id_pelabuhan,
                'status'=>'pending',
            ]);
            return redirect('/Dashboard/CRUD/DirekturData/Speedboat/View/'.$request->id_direktur)->with('success','Data Berhasil Ditambahkan!');
        }

    }

//Kapal Direktur
    public function kapal($id){
        $user_id = $id;
        $dataHakAkses=\App\hakAksesKapal::where('id_user',$id)->where('hak_akses','Direktur')->pluck('id_kapal');
        $dataKapal = \App\Kapal::whereIn('id',$dataHakAkses)->get();
        return view('Crud.direkturKapal', compact('dataKapal', 'user_id'));
    }

//Form Create Kapal
    public function createkapal($id){
        $id1=$id;
        $dataPelabuhan=\App\Pelabuhan::whereIn('tipe_pelabuhan',['feri','speedboat & feri'])->get();
        return view('Crud.direkturCreateKapal', compact('id1','dataPelabuhan'));
    }

//Create Kapal
    public function addKapal(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_kapal'=>'required',
            'kapasitas'=>'required|numeric|min:0',
            'deskripsi'=>'required',
            'tanggal_beroperasi'=>'required',
            'file'=>'required|file|image',
            'contact_service'=>'required|numeric',
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
            $dataKapal=\App\Kapal::create([
                'nama_kapal'=>$request->nama_kapal,
                'kapasitas'=>$request->kapasitas,
                'deskripsi'=>$request->deskripsi,
                'foto'=>basename($stored),
                'tipe_kapal'=>'feri',
                'tanggal_beroperasi'=>$request->tanggal_beroperasi,
                'contact_service'=>$request->contact_service,
            ]);

            \App\hakAksesKapal::create([
                'id_user'=>$request->id_direktur,
                'id_kapal'=>$dataKapal->id,
                'hak_akses'=>'Direktur',
                'contact_service'=>$request->contact_service,
            ]);

            $anggotaPelabuhan= \App\anggotaPelabuhan::create([
                'id_kapal'=>$dataKapal->id,
                'id_pelabuhan'=>$request->id_pelabuhan,
                'status'=>'pending',
    
            ]);
            return redirect('/Dashboard/CRUD/DirekturData/Kapal/View/'.$request->id_direktur)->with('success','Data Berhasil Ditambahkan!');
        } else {
            $dataKapal=\App\Kapal::create([
                'nama_kapal'=>$request->nama_kapal,
                'kapasitas'=>$request->kapasitas,
                'deskripsi'=>$request->deskripsi,
                'tipe_kapal'=>'feri',
                'tanggal_beroperasi'=>$request->tanggal_beroperasi,
                'contact_service'=>$request->contact_service,
            ]);

            \App\hakAksesKapal::create([
                'id_user'=>$request->id_direktur,
                'id_kapal'=>$dataKapal->id,
                'hak_akses'=>'Direktur',
                'contact_service'=>$request->contact_service,
            ]);

            $anggotaPelabuhan= \App\anggotaPelabuhan::create([
                'id_kapal'=>$dataKapal->id,
                'id_pelabuhan'=>$request->id_pelabuhan,
                'status'=>'pending',
    
            ]);
            return redirect('/Dashboard/CRUD/DirekturData/Kapal/View/'.$request->id_direktur)->with('success','Data Berhasil Ditambahkan!');
        }

    }

}
