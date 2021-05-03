<?php

namespace App\Http\Controllers;

use App\beritaKapal;
use App\beritaPelabuhan;
use Illuminate\Http\Request;

class publicBeritaController extends Controller
{
    public function pelabuhan($id){
        $berita = beritaPelabuhan::find($id);
        if($berita){
            return view('berita',compact('berita'));
        }
        return false;
    }

    public function kapal($id){
        $berita = beritaKapal::find($id);
        if($berita){
            return view('berita',compact('berita'));
        }
        return false;
    }
}
