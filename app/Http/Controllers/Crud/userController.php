<?php

namespace App\Http\Controllers\Crud;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{
    //
     public function viewcustomer(){
    	return view('Crud.userCustomer');
    }

    public function viewdirektur(){
    	return view('Crud.userDirektur');
    }

    public function viewadmin(){
    	return view('Crud.userAdmin');
    }

    public function viewsuperadmin(){
    	return view('Crud.userSuperAdmin');
    }

    //FORM CREATE USER
    public function create(){
        return view('Crud.createUser');
    }

    //CREATE USER
    public function addUser(Request $request)
	{
		\App\User::create([
			'nama'=>$request->nama,
			'alamat'=>$request->alamat,
			'jeniskelamin'=>$request->jeniskelamin,
			'nohp'=>$request->nohp,
			'email'=>$request->email,
			'password'=>Hash::make($request->password),
			'foto'=>$request->foto,
            'role'=>$request->role,
		]);
		return redirect('/Dashboard/CRUD/CreateUser');
	}
}
