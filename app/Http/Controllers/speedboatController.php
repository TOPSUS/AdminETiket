<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class speedboatController extends Controller
{
    //
     public function index(){
        $dataSpeedboat=\App\Kapal::where('tipe_kapal','speedboat')->get();
    	return view('Page.Speedboat',compact('dataSpeedboat'));
    }

    public function contact(){
        $dataDirektur=\App\User::where('role','Direktur')->with('speedboat')->get();
        return view('Page.speedboatContact', compact('dataDirektur'));
    }
}
