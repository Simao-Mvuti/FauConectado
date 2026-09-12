<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function showLogin(){ return view('auth.login');}
    public function showResetPassword() {return view('auth.resetpassword');}
    public function showRegister() {return view('auth.register');}
    
}
