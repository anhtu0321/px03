<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function getLogin(){
        if(Auth::check()){return redirect()->route('home');}
        return view('login');
    }
    public function postLogin(Request $request){
        if($request->remember == "remember"){
            $remember = true;
        }else{
            $remember = false;
        }
        $credentials = [
            'username' => $request->username, 
            'password' => $request->password,
        ];  
        if(Auth::attempt($credentials,$remember)){
            return redirect()->route('home');
        }else{
            $request->session()->flash('error','Tài khoản hoặc mật khẩu không đúng !');
            return redirect()->route('login');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
