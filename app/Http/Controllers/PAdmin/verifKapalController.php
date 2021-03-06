<?php

namespace App\Http\Controllers\PAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class verifKapalController extends Controller
{
    //
    public function index()
    {
        $hakAkses = \App\hakAksesPelabuhan::where('id_user', Auth::user()->id)->pluck('id_pelabuhan');
        $dataVerifikasiKapal = \App\anggotaPelabuhan::whereIn('id_pelabuhan',$hakAkses)->with('relasiPelabuhan', 'relasiKapal')->get();
        return view('PAdmin.verifikasiKapal', compact('dataVerifikasiKapal'));
    }

    //View Detail
    public function detail($id)
    {
        $dataVerifikasiKapal = \App\anggotaPelabuhan::where('id', $id)->with('relasiPelabuhan', 'relasiKapal')->first();

        return view('PAdmin.detailVerifikasiKapal', compact('dataVerifikasiKapal'));

    }

    //approve
    public function approve($id)
    {
        $dataVerifikasiKapal = \App\anggotaPelabuhan::where('id', $id)->first();
        $dataVerifikasiKapal->status = 'approve';
        $dataVerifikasiKapal->save();

        return redirect('AdminPelabuhan/VerifikasiKapal/View')->with('success','Kapal Berhasil di Approve');
    }

    //reject
    public function reject($id)
    {
        $dataVerifikasiKapal = \App\anggotaPelabuhan::where('id', $id)->first();
        $dataVerifikasiKapal->status = 'reject';
        $dataVerifikasiKapal->save();

        return redirect('AdminPelabuhan/VerifikasiKapal/View')->with('info','Kapal Berhasil di Reject');
    }

}
