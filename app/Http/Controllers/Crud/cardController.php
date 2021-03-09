<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cardController extends Controller
{
//View Card
    public function view(){
        $dataCard = \App\Card::all();
    	return view('Crud.cardView', compact('dataCard'));
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
        return redirect('/Dashboard/CRUD/Card');
    }
//Update User
    public function updateCard(Request $request){
        $dataUpdate=\App\Card::find($request->id_card);

        $dataUpdate->card=$request->card;
        $dataUpdate->save();
        return redirect()->back();
    }
//Delete User
public function deleteCard($id){
    $deleteCard=\App\Card::find($id);
    $deleteCard->delete();

    return redirect()->back();
}

}
