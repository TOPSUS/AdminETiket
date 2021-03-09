<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cardController extends Controller
{
    //
    public function view(){
    	return view('Crud.cardView');
    }
//Form Create
    public function create(){
    	return view('Crud.createCard');
    }

//Create Card
    public function addCard(Request $request)   
    {
    \App\Card::create([
        'card'=>$request->card
    ]);
        return redirect('/Dashboard/CRUD/CreateCard');
    }
}
