<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileSpeedboatController extends Controller
{
    
    //View Speedboat
    public function profile(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');
        $profiles=\App\Kapal::whereIn('id', $hakAkses)->get();

        return view('pageAdminSpeedboat.profileSpeedboat', compact('profiles'));
    }

    //Form Create Speedboat
    public function createSpeedboat(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $profile=\App\Kapal::find($dataAdmin->id_kapal);
        
        return view('CrudAdmin.createSpeedboat');
        
    }

    //Create Speedboat
    public function addSpeedboat(Request $request){
        if($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time()."_".$file->getClientOriginalName();
            $file->move(public_path().'/speedboat_image/', $file_name);
            \App\Speedboat::create([
                'nama_speedboat'=>$request->nama_speedboat,
                'kapasitas'=>$request->kapasitas,
                'deskripsi'=>$request->deskripsi,
                'tanggal_beroperasi'=>$request->tanggal_beroperasi,
                'foto'=>$file_name,
                'contact_service'=>$request->contact_service,
            ]);
            return redirect('/ProfileSpeedboat');
        } else {
            \App\Speedboat::create([
                'nama_speedboat'=>$request->nama_speedboat,
                'kapasitas'=>$request->kapasitas,
                'deskripsi'=>$request->deskripsi,
                'tanggal_beroperasi'=>$request->tanggal_beroperasi,
                'contact_service'=>$request->contact_service,
            ]);
            return redirect('/ProfileSpeedboat');
        }
    
    }

    //Update Speedboat
    public function updateSpeedboat(Request $request){
    $dataUpdate=\App\Kapal::find($request->id_kapal);

    if($request->hasfile('file')){
        $file = $request->file('file');
        $file_name = time()."_".$file->getClientOriginalName();
        $file->move(public_path().'/speedboat_image/', $file_name);
        $dataUpdate->nama_kapal=$request->nama_kapal;
        $dataUpdate->kapasitas=$request->kapasitas;
        $dataUpdate->deskripsi=$request->deskripsi;
        $dataUpdate->foto=$file_name;
        $dataUpdate->contact_service=$request->contact_service;
        $dataUpdate->tanggal_beroperasi=$request->tanggal_beroperasi;

        $dataUpdate->save();
        return redirect('/ProfileSpeedboat');
        } else {
            $dataUpdate->nama_kapal=$request->nama_kapal;
            $dataUpdate->kapasitas=$request->kapasitas;
            $dataUpdate->deskripsi=$request->deskripsi;
            $dataUpdate->contact_service=$request->contact_service;
            $dataUpdate->tanggal_beroperasi=$request->tanggal_beroperasi;
    
            $dataUpdate->save();
            return redirect('/ProfileSpeedboat');
        }
    }

    //Delete Speedboat
    public function deleteSpeedboat($id){
    $deleteSpeedboat=\App\Kapal::find($id);
    $deleteSpeedboat->delete();

    return redirect('/ProfileSpeedboat')->with('success','Berita berhasil dihapus!');
    }


}
