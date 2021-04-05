<?php

namespace App\Http\Controllers\crudAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Review;

class reviewController extends Controller
{
    
    //View Review
    public function index(){
        
        //$review=\App\Review::where('id_speedboat', $dataUser->id)->get();
        //ambil Id speedboat/kapal yang dimiliki
        $idKapal = \App\hakAksesKapal::where('id_user',Auth::user()->id)->pluck('id_kapal');
        $review = Review::with('pembelian','user')->get();

        return view('pageAdminSpeedboat.reviewSpeedboat', compact('review'));

    }
}
