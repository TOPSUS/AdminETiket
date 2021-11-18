<?php

namespace App\Http\Controllers\crudDirektur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class kapalDirekturController extends Controller
{
    //View Kapal
    public function profile()
    {
        $IdAdmin = Auth::user()->id;
        $dataAdmin = \App\User::find($IdAdmin);
        $hakAkses = \App\hakAksesKapal::where('id_user', $IdAdmin)->pluck('id_kapal');
        $anggota = \App\anggotaPelabuhan::whereIn('id_kapal', $hakAkses)->with('relasiKapal', 'relasiPelabuhan')->get();
        $profiles = \App\Kapal::whereIn('id', $hakAkses)->get();
        return view('pageDirektur.profileKapal', compact('profiles', 'anggota'));
    }

    //Form Kapal
    public function formKapal()
    {
        $dataPelabuhan = \App\Pelabuhan::all();
        return view('pageDirektur.createKapal', compact('dataPelabuhan'));
    }

    //Create Kapal
    public function createKapal(Request $request)
    {
        if ($request->tipe_kapal == 'speedboat'){
            $validator = Validator::make($request->all(), [
                'nama_kapal' => 'required',
                'tipe_kapal' => 'required|not_in:0',
                'kapasitas' => 'required|numeric',
                'reward_point' => 'required',
                'file' => 'required|file|image',
                'tanggal_beroperasi' => 'required|date',
                'contact_service' => 'required|numeric',
                'deskripsi' => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        } else {
            $validator = Validator::make($request->all(), [
                'nama_kapal' => 'required',
                'tipe_kapal' => 'required|not_in:0',
                'reward_point' => 'required',
                'file' => 'required|file|image',
                'tanggal_beroperasi' => 'required|date',
                'contact_service' => 'required|numeric',
                'deskripsi' => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/kapal_image', $file);
            $kapal = \App\Kapal::create([
                'nama_kapal' => $request->nama_kapal,
                'kapasitas' => $request->kapasitas,
                'deskripsi' => $request->deskripsi,
                'contact_service' => $request->contact_service,
                'tanggal_beroperasi' => $request->tanggal_beroperasi,
                'tipe_kapal' => $request->tipe_kapal,
                'poin' => $request->reward_point,
                'foto' => basename($stored),
            ]);

            if ($kapal) {
                $hakAkses = \App\hakAksesKapal::create([
                    'id_user' => Auth::user()->id,
                    'id_kapal' => $kapal->id,
                    'hak_akses' => 'Direktur',
                ]);
            }

            $anggotaPelabuhan = \App\anggotaPelabuhan::create([
                'id_kapal' => $kapal->id,
                'id_pelabuhan' => $request->id_pelabuhan,
                'status' => 'pending',

            ]);
            return redirect('/Direktur/Kapal')->with('success', 'Data berhasil ditambahkan!');
        } else {
            $kapal = \App\Kapal::create([
                'nama_kapal' => $request->nama_kapal,
                'kapasitas' => $request->kapasitas,
                'deskripsi' => $request->deskripsi,
                'contact_service' => $request->contact_service,
                'tanggal_beroperasi' => $request->tanggal_beroperasi,
                'poin' => $request->reward_point,
                'tipe_kapal' => $request->tipe_kapal,
            ]);

            if ($kapal) {
                $hakAkses = \App\hakAksesKapal::create([
                    'id_user' => Auth::user()->id,
                    'id_kapal' => $kapal->id,
                    'hak_akses' => 'Direktur',
                ]);
            }
            $anggotaPelabuhan = \App\anggotaPelabuhan::create([
                'id_kapal' => $kapal->id,
                'id_pelabuhan' => $request->id_pelabuhan,
                'status' => 'pending',

            ]);
            return redirect('/Direktur/Kapal')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    //Update Kapal
    public function updateKapal(Request $request)
    {
        $dataUpdate = \App\Kapal::find($request->id_kapal);

        $validator = Validator::make($request->all(), [
            'nama_kapal' => 'required',
            'kapasitas' => 'required|numeric',
            'reward_point' => 'required',
            'tanggal_beroperasi' => 'required|date',
            'contact_service' => 'required|numeric',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->with('errors', 'Oops, sepertinya terjadi kesalahan input')
                ->withInput();
        }

        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/kapal_image', $file);
            $dataUpdate->nama_kapal = $request->nama_kapal;
            $dataUpdate->kapasitas = $request->kapasitas;
            $dataUpdate->deskripsi = $request->deskripsi;
            $dataUpdate->foto = basename($stored);
            $dataUpdate->contact_service = $request->contact_service;
            $dataUpdate->tanggal_beroperasi = $request->tanggal_beroperasi;
            $dataUpdate->poin = $request->reward_point;

            $dataUpdate->save();
            return redirect('/Direktur/Kapal')->with('success', 'Data berhasil diupdate!');
        } else {
            $dataUpdate->nama_kapal = $request->nama_kapal;
            $dataUpdate->kapasitas = $request->kapasitas;
            $dataUpdate->deskripsi = $request->deskripsi;
            $dataUpdate->contact_service = $request->contact_service;
            $dataUpdate->tanggal_beroperasi = $request->tanggal_beroperasi;
            $dataUpdate->poin = $request->reward_point;

            $dataUpdate->save();
            return redirect('/Direktur/Kapal')->with('success', 'Data berhasil diupdate!');
        }
    }

    //Delete Jadwal
    public function deleteKapal($id)
    {
        $deleteItem = \App\Kapal::find($id);
        $deleteItem->delete();
        return redirect('/Direktur/Kapal')->with('info', 'Data berhasil dihapus!');
    }

    //Form List Admin
    public function viewAdmin($id)
    {
        $IdKapal = $id;
        $hakAkses = \App\hakAksesKapal::where('id_kapal', $id)->where('hak_akses', 'Admin')->pluck('id_user');
        $user = \App\User::whereIn('id', $hakAkses)->get();

        return view('pageDirektur.listAdmin', compact('user', 'IdKapal'));
    }

    //Create Tambah Admin
    public function createAdmin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:App\User,email',
            'no_hp' => 'required|numeric',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $admin = \App\User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nohp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'Admin',
            'foto' => 'avatar5.png',
        ]);

        if ($admin) {
            $hakAkses = \App\hakAksesKapal::create([
                'id_kapal' => $request->id_kapal,
                'id_user' => $admin->id,
                'hak_akses' => "Admin",
            ]);
        }

        return redirect('/Direktur/Kapal')->with('success', 'Data berhasil ditambahkan!!');
    }

    //Update Admin
    public function updateAdmin(Request $request)
    {
        $dataUpdate = \App\User::find($request->id_user);
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_hp' => 'required|numeric',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($dataUpdate) {
            if ($request->password != null) {
                $dataUpdate->nama = $request->nama;
                $dataUpdate->nohp = $request->no_hp;
                $dataUpdate->password = Hash::make($request->password);
                $dataUpdate->save();
            } else {
                $dataUpdate->nama = $request->nama;
                $dataUpdate->nohp = $request->no_hp;
                $dataUpdate->save();
            }
        }
        return redirect('/Direktur/Kapal/ListAdmin/' . $request->id_kapal)->with('success', 'Data berhasil diupdate!!');;
    }

    //Delete Admin
    public function deleteAdmin($id)
    {
        $deleteUser = \App\User::find($id);
        $deleteUser->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
