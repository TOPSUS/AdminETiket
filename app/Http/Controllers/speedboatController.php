<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class speedboatController extends Controller
{
    //
     public function index(){
    	return view('Page.Speedboat');
    }

    public function contact(){
        $dataDirektur=\App\User::where('role','Direktur')->with('speedboat')->get();
        return view('Page.speedboatContact', compact('dataDirektur'));
    }
}
