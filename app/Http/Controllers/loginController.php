<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class loginController extends Controller
{
    //
     public function index(){
    	return view('formLogin');
    }

    public function loginAdmin(Request $request){
        $data = \App\User::where('email',$request->email)->first();
        if($data){
            if(Hash::check($request->password, $data->password)) {
                if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                    if($data->role=="SAdmin"){
                        session(['SAdmin'=>true]);
                        return redirect('/Admin/Dashboard');
                    
                    }
                    elseif ($data->role=="Admin"){
                        session(['Admin'=>true]);
                        return redirect('/UTIK');
                    }
                    elseif ($data->role=="Direktur"){
                        session(['Direktur'=>true]);
                        return redirect('/Love');
                    }
                    else{
                        return redirect('/');
                    } 
                }
                else {
                    return redirect('/');
                }
            }
            else {
                return redirect('/');
            }
        }
        else {
            return redirect('/');
        }
    }

    public function logoutAdmin(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
}
