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
    	return view('Page.speedboatContact');
    }
}
