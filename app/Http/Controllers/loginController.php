<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class loginController extends Controller
{
    //
    public function index(Request $request)
    {
        if (session('SAdmin')) {
            return redirect('/Admin/Dashboard');
        } elseif (session('Admin')) {
            return redirect('/Admin/Home');
        } elseif (session('Direktur')) {
            return redirect('/Direktur/Home');
        } else {
            return view('formLogin');
        }
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $data = \App\User::where('email', $request->email)->first();
        if ($data) {
            if (Hash::check($request->password, $data->password)) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    if ($data->role == "SAdmin") {
                        session(['SAdmin' => true]);
                        return redirect('/Admin/Dashboard');
                    } elseif ($data->role == "Admin") {
                        session(['Admin' => true]);
                        return redirect('/Admin/Home');
                    } elseif ($data->role == "Direktur") {
                        session(['Direktur' => true]);
                        return redirect('/Direktur/Home');
                    }
                } else {
                    return redirect()->back()->withInput($request->only('email'))->with('info', 'tidak dapat melakukan login, harap menghubungi contact service yang tersedia!!');
                }
            } else {
                return redirect()->back()->withInput($request->only('email'))->with('info', 'Password yang anda masukan salah!!');
            }
        }
        return redirect()->back()->withInput($request->only('email'))->with('info', 'Email yang anda masukan salah!!');
    }

    public function logoutAdmin(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}

