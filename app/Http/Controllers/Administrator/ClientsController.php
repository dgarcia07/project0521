<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\City;

class ClientsController extends Controller
{
   public function index(Request $request)
   {
      $clients = Client::cod($request->cod)
      ->name($request->name)
      ->city($request->city)
      ->state($request->state)
      ->paginate(7);
      $cities = City::where('state', 1)->get();
      return view('administrator.clients.index', ['clients' => $clients, 'cities' => $cities]);
   }

   public function store(Request $request)
   {
      $request->validate([
         'cod' => 'required|unique:clients',
         'name' => 'required',
         'city' => 'required|exists:cities,id',
         'state' => 'required',
      ],[
         'cod.required' => 'El campo codigo es obligatorio.',
         'cod.unique' => 'El valor del campo codigo ya está en uso.',
         'name.required' => 'El campo nombre es obligatorio.',
         'city.required' => 'El campo ciudad es obligatorio.',
         'city.exists' => 'El valor ingresado no existe.',
         'state.required' => 'El campo estado es obligatorio.',
      ]);

      try {
         DB::table('clients')->insert([
            'cod' => $request->cod,
            'name' => $request->name,
            'city' => $request->city,
            'state' => $request->state
         ]);

         session()->flash('success', 'Cliente agregado correctamente');
         return back();
      } catch (\Exception $e) {
         session()->flash('danger', 'Hemos tenido problemas, intenta más tarde');
         return back();
      }
   }

   public function edit($id)
   {
      try {
         $client = DB::table('clients')->where('id', $id)->first();
         return response()->json([
            'code' => 200,
            'data' => $client,
            'message' => 'Información del cliente'
         ], 200);
      } catch (\Exception $e) {
         return response()->json([
            'code' => 400,
            'data' => [],
            'message' => 'Cliente no disponible'
         ], 400);
      }
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'cod' => 'required',
         'name' => 'required',
         'city' => 'required|exists:cities,id',
         'state' => 'required',
      ],[
         'cod.required' => 'El campo codigo es obligatorio.',
         'cod.unique' => 'El valor del campo codigo ya está en uso.',
         'name.required' => 'El campo nombre es obligatorio.',
         'city.required' => 'El campo ciudad es obligatorio.',
         'city.exists' => 'El valor ingresado no existe.',
         'state.required' => 'El campo estado es obligatorio.',
      ]);

      try {
         DB::table('clients')->where('id', $id)->update([
            'cod' => $request->cod,
            'name' => $request->name,
            'city' => $request->city,
            'state' => $request->state
         ]);

         session()->flash('success', 'Cliente actualizado correctamente');
         return back();
      } catch (\Exception $e) {
         session()->flash('danger', 'Hemos tenido problemas, intenta más tarde');
         return back();
      }
   }

   public function destroy($id)
   {
      try {
         $clients = Client::find($id);
         $clients->delete();

         return response()->json([
            'code' => 200,
            'data' => [],
            'message' => 'Cliente eliminado correctamente!'
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
