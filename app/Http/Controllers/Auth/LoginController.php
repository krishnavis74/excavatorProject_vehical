<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    

    public function login_url(Request $request)
    {
        // dd($request->all());

        $this->validate(
            $request,
            [
                'email'=>'required',
                'password'=>'required'
            ],
            [
                'email.required'=>'User name is required',
                'password.required'=>'Password is required'
            ]
        );

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->intended('index_page');

        }
        else{
            return view('auth.loginpage')->with('error_msg', "User Name and Password not match");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return view('auth.loginpage');
    }
}
