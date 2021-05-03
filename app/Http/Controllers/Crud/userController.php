<?php

namespace App\Http\Controllers\Crud;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{
    //
    public function viewcustomer(){
        $dataCustomer=\App\User::where('role','Customer')->get();
    	return view('Crud.userCustomer', compact('dataCustomer'));
    }

    public function viewdirektur(){
        $dataDirektur=\App\User::where('role','Direktur')->with('kapal')->get();
    	return view('Crud.userDirektur', compact('dataDirektur'));
    }

    public function viewadmin(){
        $dataAdmin=\App\User::where('role','Admin')->with('kapal')->get();
    	return view('Crud.userAdmin', compact('dataAdmin'));
    }

    public function viewsuperadmin(){
        $dataSAdmin=\App\User::where('role','SAdmin')->get();
    	return view('Crud.userSuperAdmin', compact('dataSAdmin'));
    }

//FORM CREATE USER
    public function create(){
        return view('Crud.createUser');
    }

//FORM CREATE DIREKTUR
public function createdirektur(){
    return view('Crud.createDirektur');
}

//FORM CREATE ADMIN
public function createadmin(){
    $dataSpeedboat=\App\Kapal::where('tipe_kapal','speedboat')->get();
    return view('Crud.createAdmin', compact('dataSpeedboat'));
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
            'role'=>$request->role,
		]);
        return redirect('/Dashboard/CRUD/CustomerData')->with('success','Data berhasil dibuat!');
	}

//CREATE DIREKTUR
public function addDirektur(Request $request)
{

    \App\User::create([
        'nama'=>$request->nama,
        'alamat'=>$request->alamat,
        'jeniskelamin'=>$request->jeniskelamin,
        'nohp'=>$request->nohp,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'role'=>'Direktur',
    ]);
    return redirect('/Dashboard/CRUD/DirekturData');
}

//CREATE Admin
public function addAdmin(Request $request)
{
    \App\User::create([
        'nama'=>$request->nama,
        'alamat'=>$request->alamat,
        'jeniskelamin'=>$request->jeniskelamin,
        'nohp'=>$request->nohp,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'id_kapal'=>$request->id_kapal,
        'role'=>'Admin',
    ]);
    return redirect('/Dashboard/CRUD/AdminData');
}


//Update User
    public function updateUser(Request $request){
        $dataUpdate=\App\User::find($request->id_user);

        $dataUpdate->nama=$request->nama;
        $dataUpdate->alamat=$request->alamat;
        $dataUpdate->jeniskelamin=$request->jeniskelamin;
        $dataUpdate->nohp=$request->nohp;
        $dataUpdate->email=$request->email;
        $dataUpdate->role=$request->role;

        $dataUpdate->save();
        return redirect()->back();
    }

//Delete User
public function deleteUser($id){
    $deleteUser=\App\User::find($id);
    $deleteUser->delete();

    return redirect()->back();
}

}
