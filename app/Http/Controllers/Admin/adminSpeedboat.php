<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminSpeedboat extends Controller
{
    //
    public function index(){
    	return view('adminSpeedboat.homeAdmin');
    }

    public function profile(){
        $IdAdmin=Auth::user()->id;
        $dataAdmin=\App\User::find($IdAdmin);
        $profile=\App\Speedboat::find($dataAdmin->id_speedboat);

        return view('pageAdminSpeedboat.profileSpeedboat', compact('profile'));
    }


}
