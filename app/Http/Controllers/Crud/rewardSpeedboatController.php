<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class rewardSpeedboatController extends Controller
{
    //
    public function view(){
    	return view('Crud.rewardSpeedboatView');
    }

    public function create(){
    	return view('Crud.createRewardSpeedboat');
    }

}
