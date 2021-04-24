<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class kapalController extends Controller
{
    //
    public function index(){
        $dataKapal=\App\Kapal::where('tipe_kapal','feri')->get();
        return view('Page.Kapal', compact('dataKapal'));
 
    }
}
