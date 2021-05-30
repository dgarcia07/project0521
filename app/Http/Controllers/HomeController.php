<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function setPassword(Request $request)
    {
       $email = $request->e;
       $confimation = $request->t;
       if (!empty($email) && !empty($confimation)) {
          $user = User::where('email', $email)->where('confirmation_token', $confimation)->first();
          if (!empty($user)) {
             return view('auth.passwords.set', ['user' => $user]);
          }
       }

       return redirect('/');
    }

    public function setPasswordStore(Request $request)
    {
       $request->validate([
          'email' => 'required',
          'confirmation_token' => 'required',
          'password' => 'required|confirmed|min:6'
       ],[
          'email.required' => 'El campo correo es obligatorio.',
          'confirmation_token.required' => 'Formato incorrecto.',
          'password.required' => 'El campo de contraseña es obligatorio.',
          'password.confirmed' => 'La contraseña no coincide.',
          'password.min' => 'Minimo de 6 caracteres.',
       ]);

       try {
          DB::table('users')->where('email', $request->email)
          ->where('confirmation_token', $request->confirmation_token)
          ->update([
             'password' => Hash::make($request->password),
             'confirmation_token' => null
          ]);

          session()->flash('success', 'Contraseña establecida correctamente');
          return redirect('/');
       } catch (\Exception $e) {
          session()->flash('danger', 'Hemos tenido problemas, intenta más tarde');
          return redirect('/');
       }
    }
}
