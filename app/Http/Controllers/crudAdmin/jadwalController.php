<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jadwalController extends Controller
{
    //
    public function index(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $profile=\App\Speedboat::find($dataAdmin->id_speedboat);
        $jadwal=\App\Jadwal::where('id_speedboat', $profile->id)->with('asal','tujuan')->get();
        $pelabuhan=\App\Pelabuhan::all();

        return view('pageAdminSpeedboat.jadwalView', compact('jadwal', 'pelabuhan'));

    }

    
}
