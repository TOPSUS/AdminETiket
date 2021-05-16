<?php

namespace App\Http\Controllers;

use App\beritaKapal;
use App\beritaPelabuhan;
use Illuminate\Http\Request;

class publicBeritaController extends Controller
{
    public function pelabuhan($id){

        $type = 'pelabuhan';
        $blog = beritaPelabuhan::with('relasiUser')->find($id);
        if($blog){
            return view('blog',compact('blog','type'));
        }
        return false;
    }

    public function kapal($id){
        $type = 'kapal';
        $blog = beritaKapal::with('relasiUser')->find($id);
        if($blog){
            return view('blog',compact('blog','type'));
        }
        return false;
    }
}
