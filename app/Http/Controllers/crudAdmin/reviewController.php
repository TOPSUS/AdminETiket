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
        $review = Review::getAllReview();

        return view('pageAdminSpeedboat.reviewSpeedboat', compact('review'));

    }
}
