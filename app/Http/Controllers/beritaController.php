<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class beritaController extends Controller
{
    //
    public function index(){
    	return view('Page.Berita');
    }

    public function create(){
    	return view('Page.createBerita');
    }
}
