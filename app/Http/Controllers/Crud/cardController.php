<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class cardController extends Controller
{
//View Card
    public function view()
    {
        $dataCard = \App\Card::all();
        return view('Crud.cardView', compact('dataCard'));
    }

//Form Create
    public function create()
    {
        return view('Crud.createCard');
    }

//Create Card
    public function addCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\Card::create([
            'card' => $request->card
        ]);
        return redirect('/Dashboard/CRUD/Card')->with('success', 'Card telah berhasil ditambahkan!');
    }

//Update Card
    public function updateCard(Request $request)
    {
        $dataUpdate = \App\Card::find($request->id_card);

        $dataUpdate->card = $request->card;
        $dataUpdate->save();
        return redirect()->back()->with('success', 'Card telah diupdate');
    }

//Delete Card
    public function deleteCard($id)
    {
        $deleteCard = \App\Card::find($id);
        $deleteCard->delete();

        return redirect()->back()->with('info', 'Card telah hapus');
    }

}
