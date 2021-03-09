<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class jadwalController extends Controller
{
    //
    public function view(){
    	return view('Crud.jadwalView');
    }

    public function create(){
    	return view('Crud.createJadwal');
    }

}
