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

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()
        ->route('login')
        ->with('sucesso', 'Logout realizado com sucesso');
}
    
    public function login(Request $request){
      $request->validate([
        'email'=>'required|email',
        'password'=>'required|min:4|max:20'
      ]);

      $resultado = Auth::attempt([
        "email"=>$request->email,
        "password"=>$request->password,
      ]);

      if (!$resultado){
        return back()->with('erro','credencias inválidos');
      }

      $request->session()->regenerate();
      return redirect('dashboard')->with('sucesso','Login realizado com sucesso');
    }

    public function register(Request $request){
      $request->validate([
            'name'=>'required|min:2|string',
            'email'=>'required|email|unique:users',
            'role'=>'required|string|in:mentee,mentor',
            'password'=>'required|min:4|max:20|confirmed'
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

      return redirect()->route('dashboard')->with('sucesso','Cadastro realizado com sucesso');
    }

    
}
