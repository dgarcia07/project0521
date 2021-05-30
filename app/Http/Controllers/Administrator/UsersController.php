<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersController extends Controller
{
   public function index(Request $request)
   {
      $users = User::name($request->name)
      ->email($request->email)
      ->state($request->state)
      ->paginate(7);
      return view('administrator.users.index', ['users' => $users]);
   }

   public function store(Request $request)
   {
      $request->validate([
         'name' => 'required',
         'email' => 'required|email|unique:users'
      ],[
         'name.required' => 'El campo nombre es obligatorio.',
         'email.required' => 'El campo correo es obligatorio.',
         'email.email' => 'El valor del campo debe ser un correo',
         'email.unique' => 'El valor del campo codigo ya está en uso.',
      ]);

      try {
         $random = Str::random(40);

         User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => Hash::make('secret'),
            'confirmation_token' => $random
         ]);

         session()->flash('success', 'Usuario creado correctamente');
         return back();
      } catch (\Exception $e) {
         dd($e);
         session()->flash('danger', 'Hemos tenido problemas, intenta más tarde');
         return back();
      }
   }

   public function edit($id)
   {
      try {
         $client = DB::table('users')->where('id', $id)->first();
         return response()->json([
            'code' => 200,
            'data' => $client,
            'message' => 'Información del usuario'
         ], 200);
      } catch (\Exception $e) {
         return response()->json([
            'code' => 400,
            'data' => [],
            'message' => 'Usuario no disponible'
         ], 400);
      }
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'name' => 'required',
         'email' => 'required|email',
         'state' => 'required',
      ],[
         'name.required' => 'El campo nombre es obligatorio.',
         'email.required' => 'El campo correo es obligatorio.',
         'email.email' => 'Debe enviar un correo.',
         'state.required' => 'El campo estado es obligatorio.',
      ]);

      try {
         $email = User::whereNotIn('id', [$id])->where('email', $request->email)->exists();
         if ($email) {
            session()->flash('danger', 'El correo ingresado, ya está en uso');
            return back();
         }

         if ($id==1) {$request->state = 1;}

         DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'state' => $request->state
         ]);

         session()->flash('success', 'Usuario actualizado correctamente');
         return back();
      } catch (\Exception $e) {
         session()->flash('danger', 'Hemos tenido problemas, intenta más tarde');
         return back();
      }
   }

   public function destroy($id)
   {
      try {
         $users = User::find($id);
         $users->delete();

         return response()->json([
            'code' => 200,
            'data' => [],
            'message' => 'Usuario eliminado correctamente!'
         ], 200);
      } catch (\Exception $e) {
         return response()->json([
            'code' => 400,
            'data' => [],
            'message' => 'Hemos tenido problemas, intenta más tarde'
         ], 400);
      }
   }
}
