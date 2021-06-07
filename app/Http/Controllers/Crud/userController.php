<?php

namespace App\Http\Controllers\Crud;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function viewadminpelabuhan(){
        $dataAdmin=\App\User::where('role','PAdmin')->with('pelabuhan')->get();
    	return view('Crud.userAdminPelabuhan', compact('dataAdmin'));
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
    $dataSpeedboat=\App\Kapal::all();
    return view('Crud.createAdmin', compact('dataSpeedboat'));
}

//FORM CREATE ADMIN PELABUHAN
public function createadminpelabuhan(){
    $dataPelabuhan=\App\Pelabuhan::all();
    return view('Crud.createAdminPelabuhan', compact('dataPelabuhan'));
}

//CREATE USER
    public function addUser(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'alamat'=>'required',
            'jeniskelamin'=>'required',
            'nohp'=>'required|numeric',
            'email'=>'required|unique:App\User,email',
            'password'=>'required',
            'role'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

		\App\User::create([
			'nama'=>$request->nama,
			'alamat'=>$request->alamat,
			'jeniskelamin'=>$request->jeniskelamin,
			'nohp'=>$request->nohp,
			'email'=>$request->email,
			'password'=>Hash::make($request->password),
            'role'=>$request->role,
            'foto'=>'avatar5.png',
		]);
        if($request->role != 'SAdmin'){
            return redirect('/Dashboard/CRUD/CustomerData')->with('success','Data berhasil dibuat!');
        } return redirect('/Dashboard/CRUD/SuperAdminData')->with('success','Data berhasil dibuat!');
	}

//CREATE DIREKTUR
    public function addDirektur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'alamat'=>'required',
            'jeniskelamin'=>'required',
            'nohp'=>'required|numeric',
            'email'=>'required|unique:App\User,email',
            'password'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\User::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'jeniskelamin'=>$request->jeniskelamin,
            'nohp'=>$request->nohp,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'Direktur',
            'foto'=>'avatar5.png',
        ]);
        return redirect('/Dashboard/CRUD/DirekturData')->with('success','Data berhasil dibuat!');
    }

//CREATE Admin
    public function addAdmin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'alamat'=>'required',
            'jeniskelamin'=>'required',
            'nohp'=>'required|numeric',
            'email'=>'required|unique:App\User,email',
            'password'=>'required',
            'id_speedboat'=>'required|not_in:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        \App\User::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'jeniskelamin'=>$request->jeniskelamin,
            'nohp'=>$request->nohp,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'id_speedboat'=>$request->id_speedboat,
            'role'=>'Admin',
            'foto'=>'avatar5.png',
        ]);
        return redirect('/Dashboard/CRUD/AdminData')->with('success','Data berhasil dibuat!');
    }

//CREATE Admin Pelabuhan
    public function addAdminPelabuhan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama'=>'required',
            'alamat'=>'required',
            'jeniskelamin'=>'required',
            'nohp'=>'required|numeric',
            'email'=>'required|unique:App\User,email',
            'password'=>'required',
            'id_pelabuhan'=>'required|not_in:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $padmin = \App\User::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'jeniskelamin'=>$request->jeniskelamin,
            'nohp'=>$request->nohp,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'id_pelabuhan'=>$request->id_speedboat,
            'role'=>'PAdmin',
        ]);
        $hakakses= \App\hakAksesPelabuhan::create([
            'id_user'=>$padmin->id,
            'id_pelabuhan'=>$request->id_pelabuhan,
            'hak_akses'=>'PAdmin',
            'foto'=>'avatar5.png',
        ]);

        return redirect('/Dashboard/CRUD/AdminPelabuhanData')->with('success','Data berhasil dibuat!');
    }


//Update User
    public function updateUser(Request $request){
        $dataUpdate=\App\User::find($request->id_user);
        if($dataUpdate->email != $request->email){
            $validator = Validator::make($request->all(), [
                'nama'=>'required',
                'alamat'=>'required',
                'jeniskelamin'=>'required',
                'nohp'=>'required|numeric',
                'email'=>'required|unique:App\User,email',
                'role'=>'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        } else {
            $validator = Validator::make($request->all(), [
                'nama'=>'required',
                'alamat'=>'required',
                'jeniskelamin'=>'required',
                'nohp'=>'required|numeric',
                'role'=>'required',
                'foto'=>'avatar5.png',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }


        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $stored = Storage::disk('admin')->putFile('/image_users', $file);
            $dataUpdate->nama=$request->nama;
            $dataUpdate->alamat=$request->alamat;
            $dataUpdate->jeniskelamin=$request->jeniskelamin;
            $dataUpdate->nohp=$request->nohp;
            $dataUpdate->email=$request->email;
            $dataUpdate->role=$request->role;
            $dataUpdate->foto = basename($stored);
            $dataUpdate->save();
            return redirect()->back()->with('success','Data Berhasil diupdate!');;
        } else {
            $dataUpdate->nama=$request->nama;
            $dataUpdate->alamat=$request->alamat;
            $dataUpdate->jeniskelamin=$request->jeniskelamin;
            $dataUpdate->nohp=$request->nohp;
            $dataUpdate->email=$request->email;
            $dataUpdate->role=$request->role;
            $dataUpdate->save();
            return redirect()->back()->with('success','Data Berhasil diupdate!');;
        }
    }

//Delete User
public function deleteUser($id){
    $deleteUser=\App\User::find($id);
    $deleteUser->delete();

    return redirect()->back()->with('info','Data berhasil hapus!');
}

}
