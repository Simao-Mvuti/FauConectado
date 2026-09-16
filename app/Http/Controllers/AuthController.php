<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(){ return view('auth.login');}
    public function showForgotPassword() {return view('auth.forgotpassword');}
    public function showResetPassword(Request $request, string $token) {return view('auth.resetpassword', ['token' => $token, 'email' => $request->query('email')]);}
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
        'password'=>'required|string'
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
        'password'=>'required|string|min:8|max:255|confirmed'
      ]);

      $name = $request->name;
      $email = $request->email;
      $password = Hash::make($request->password);

      $user = new User([
        'name' => $name,
        'email' => $email,
        'role' => 'mentee',
        'password' => $password
      ]);
      $user->save();
      Auth::login($user);

      return redirect()->route('dashboard')->with('sucesso','Cadastro realizado com sucesso');
    }

    public function sendResetLinkEmail(Request $request)
    {
      $request->validate(['email' => ['required', 'email']]);

      Password::send($request->only('email'));

      return back()->with('sucesso', 'Se o e-mail estiver cadastrado, você receberá um link para redefinir a senha.');
    }

    public function resetPassword(Request $request)
    {
      $dados = $request->validate([
        'token' => ['required', 'string'],
        'email' => ['required', 'email'],
        'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
      ]);

      $status = Password::reset(
        $dados,
        function (User $user, string $password): void {
          $user->forceFill([
            'password' => $password,
            'remember_token' => Str::random(60),
          ])->save();
        },
      );

      if ($status !== Password::PASSWORD_RESET) {
        return back()->withErrors(['email' => 'Não foi possível redefinir a senha. Solicite um novo link.']);
      }

      return redirect()->route('login')->with('sucesso', 'Senha redefinida com sucesso.');
    }

    
}
