<?php

namespace App\Http\Controllers\crudDirektur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Review;

class reviewDirekturController extends Controller
{
    //View Review
    public function index(){
        
        //ambil Id speedboat/kapal yang dimiliki
        $idKapal = \App\hakAksesKapal::where('id_user',Auth::user()->id)->pluck('id_kapal');
        $review = Review::with('pembelian','user')->get();

        return view('pageDirektur.reviewKapal', compact('review'));

    }
}
