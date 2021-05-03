<?php

namespace App\Http\Controllers\crudDirektur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class kapalDirekturController extends Controller
{
    //View Kapal
    public function profile(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $hakAkses=\App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');
        $profiles=\App\Kapal::whereIn('id', $hakAkses)->get();

        return view('pageDirektur.profileKapal', compact('profiles'));
    }

    //Form Kapal
    public function formKapal(){
        return view('pageDirektur.createKapal');
    }

    //Create Kapal
    public function createKapal(Request $request){

        if($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time()."_".$file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/kapal_image', $file);
            $kapal = \App\Kapal::create([
                'nama_kapal'=>$request->nama_kapal,
                'kapasitas'=>$request->kapasitas,
                'deskripsi'=>$request->deskripsi,
                'contact_service'=>$request->contact_service,
                'tanggal_beroperasi'=>$request->tanggal_beroperasi,
                'tipe_kapal'=>$request->tipe_kapal,
                'foto'=>basename($stored),
            ]);

            if($kapal){
                $hakAkses = \App\hakAksesKapal::create([
                    'id_user'=>Auth::user()->id,
                    'id_kapal'=>$kapal->id,
                    'hak_akses'=>'Direktur',
                ]);
            }
            return redirect('/Direktur/Kapal');
        } else {
            $kapal = \App\Kapal::create([
                'nama_kapal'=>$request->nama_kapal,
                'kapasitas'=>$request->kapasitas,
                'deskripsi'=>$request->deskripsi,
                'contact_service'=>$request->contact_service,
                'tanggal_beroperasi'=>$request->tanggal_beroperasi,
                'tipe_kapal'=>$request->tipe_kapal,
            ]);

            if($kapal){
                $hakAkses = \App\hakAksesKapal::create([
                    'id_user'=>Auth::user()->id,
                    'id_kapal'=>$kapal->id,
                    'hak_akses'=>'Direktur',
                ]);
            }
            return redirect('/Direktur/Kapal');
        }
    }

    //Update Kapal
    public function updateKapal(Request $request){
    $dataUpdate=\App\Kapal::find($request->id_kapal);

    if($request->hasfile('file')){
        $file = $request->file('file');
        $file_name = time()."_".$file->getClientOriginalName();
        $stored = Storage::disk('admin')->putFile('/kapal_image', $file);
        $dataUpdate->nama_kapal=$request->nama_kapal;
        $dataUpdate->kapasitas=$request->kapasitas;
        $dataUpdate->deskripsi=$request->deskripsi;
        $dataUpdate->foto=basename($stored);
        $dataUpdate->contact_service=$request->contact_service;
        $dataUpdate->tanggal_beroperasi=$request->tanggal_beroperasi;

        $dataUpdate->save();
        return redirect('/Direktur/Kapal');
        } else {
            $dataUpdate->nama_kapal=$request->nama_kapal;
            $dataUpdate->kapasitas=$request->kapasitas;
            $dataUpdate->deskripsi=$request->deskripsi;
            $dataUpdate->contact_service=$request->contact_service;
            $dataUpdate->tanggal_beroperasi=$request->tanggal_beroperasi;

            $dataUpdate->save();
            return redirect('/Direktur/Kapal');
        }
    }

    //Delete Jadwal
    public function deleteKapal($id){
        $deleteItem = \App\Kapal::find($id);
        $deleteItem->delete();
        return redirect('/Direktur/Kapal')->with('success','Berita berhasil dihapus!');
    }

    //Form List Admin
    public function viewAdmin($id){
        $IdKapal = $id;
        $hakAkses = \App\hakAksesKapal::where('id_kapal',$id)->where('hak_akses','Admin')->pluck('id_user');
        $user = \App\User::whereIn('id', $hakAkses)->get();

        return view('pageDirektur.listAdmin', compact('user','IdKapal'));
    }

    //Create Tambah Admin
    public function createAdmin(Request $request){
        $admin = \App\User::create([
            'nama'=>$request->nama,
            'email'=>$request->email,
            'nohp'=>$request->no_hp,
            'password'=>Hash::make($request->password),
        ]);

        if($admin){
            $hakAkses = \App\hakAksesKapal::create([
                'id_kapal'=>$request->id_kapal,
                'id_user'=>$admin->id,
                'hak_akses'=>"Admin",
            ]);
        }

        return redirect('/Direktur/Kapal');
    }

    //Update Admin
    public function updateAdmin(Request $request){
        $dataUpdate = \App\User::find($request->id_user);
        if($dataUpdate){

            if($request->password != null){
                $dataUpdate->nama=$request->nama;
                $dataUpdate->email=$request->email;
                $dataUpdate->nohp=$request->no_hp;
                $dataUpdate->password=Hash::make($request->password);
                $dataUpdate->save();
            }else{
                $dataUpdate->nama=$request->nama;
                $dataUpdate->email=$request->email;
                $dataUpdate->nohp=$request->no_hp;
                $dataUpdate->save();
            }
        }
        return redirect('/Direktur/Kapal/ListAdmin/'.$request->id_kapal);
    }

    //Delete Admin
    public function deleteAdmin($id){
        $deleteUser = \App\User::find($id);
        $deleteUser->delete();
        return redirect()->back()->with('success','Admin berhasil dihapus!');
    }
}
