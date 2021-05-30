<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\City;

class CitiesController extends Controller
{
   public function index(Request $request)
   {
      $cities = City::cod($request->cod)
      ->name($request->name)
      ->state($request->state)
      ->paginate(7);
      return view('administrator.cities.index', ['cities' => $cities]);
   }

   public function store(Request $request)
   {
      $request->validate([
         'cod' => 'required|unique:cities',
         'name' => 'required',
         'state' => 'required',
      ],[
         'cod.required' => 'El campo codigo es obligatorio.',
         'cod.unique' => 'El valor del campo codigo ya está en uso.',
         'name.required' => 'El campo nombre es obligatorio.',
         'name.required' => 'El campo estado es obligatorio.',
      ]);

      try {
         DB::table('cities')->insert([
            'cod' => $request->cod,
            'name' => $request->name,
            'state' => $request->state
         ]);

         session()->flash('success', 'Ciudad agregada correctamente');
         return back();
      } catch (\Exception $e) {
         session()->flash('danger', 'Hemos tenido problemas, intenta más tarde');
         return back();
      }
   }

   public function edit($id)
   {
      try {
         $city = DB::table('cities')->where('id', $id)->first();
         return response()->json([
            'code' => 200,
            'data' => $city,
            'message' => 'Información de la ciudad'
         ], 200);
      } catch (\Exception $e) {
         return response()->json([
            'code' => 400,
            'data' => [],
            'message' => 'Ciudad no disponible'
         ], 400);
      }
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'cod' => 'required',
         'name' => 'required',
         'state' => 'required',
      ],[
         'cod.required' => 'El campo codigo es obligatorio.',
         'cod.unique' => 'El valor del campo codigo ya está en uso.',
         'name.required' => 'El campo nombre es obligatorio.',
         'state.required' => 'El campo estado es obligatorio.',
      ]);

      try {
         DB::table('cities')->where('id', $id)->update([
            'cod' => $request->cod,
            'name' => $request->name,
            'state' => $request->state
         ]);

         session()->flash('success', 'Ciudad actualizada correctamente');
         return back();
      } catch (\Exception $e) {
         session()->flash('danger', 'Hemos tenido problemas, intenta más tarde');
         return back();
      }
   }

   public function destroy($id)
   {
      try {
         $cities = City::find($id);
         $cities->delete();

         return response()->json([
            'code' => 200,
            'data' => [],
            'message' => 'Ciudad eliminada correctamente!'
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
