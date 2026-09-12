<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(){ return view('auth.login');}
    public function showResetPassword() {return view('auth.resetpassword');}
    public function showRegister() {return view('auth.register');}


    public function login(Request $request){
      $request->validate([
        'email'=>'required|email',
        'password'=>'required|min:4|max:20'
      ]);

      $resultado = Auth::attempt([
        "email"=>$request->email,
        "passwor"=>$request->passwprd,
      ]);

      if (!$resultado){
        return back()->with('erro','credencias inválidos');
      }

      return redirect('dashboard');
    }

    public function register(Request $request){
      $request->validate([
            'name'=>'required|min:2|string',
            'email'=>'required|email|unique:users',
            'role'=>'required|string|in:mentee,mentor',
            'password'=>'required|min:4|max:20'
      ]);

      $name = $request->name;
      $email = $request->email;
      $role = $request->role;
      $password = Hash::make($request->password);

      $user = new User([
        'name' => $name,
        'email' => $email,
        'role' => $role,
        'password' => $password
      ]);
      $user->save();
      Auth::login($user);
      return redirect()->route('dashboard');
    }

    
}
