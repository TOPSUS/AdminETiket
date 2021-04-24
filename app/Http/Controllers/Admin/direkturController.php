<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class direkturController extends Controller
{
    //
    public function index(){
    	return view('direkturKapal.homeDirektur');
    }
}
