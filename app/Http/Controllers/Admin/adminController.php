<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class adminController extends Controller
{
    //
    public function index(){
        $dataUser = \App\User::where('role','Customer')->count();
        $dataSpeedboat = \App\Kapal::where('tipe_kapal','speedboat')->count();
        $dataKapal = \App\Kapal::where('tipe_kapal','feri')->count();
        $dataPelabuhan = \App\Pelabuhan::count();
    	return view('adminDashboard.homeAdmin',compact ('dataUser','dataSpeedboat','dataKapal','dataPelabuhan'));
    }

    public function contact(){
        $dataSAdmin=\App\User::where('role','SAdmin')->get();
    	return view('Page.contactUs', compact('dataSAdmin'));
    }
}
