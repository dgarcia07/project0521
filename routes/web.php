<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);
Route::get('register', 'Auth\RegisterController@index')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('post.register');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('setPassword', 'HomeController@setPassword')->name('setPassword');
Route::post('setPassword', 'HomeController@setPasswordStore')->name('post.setPassword');

Route::middleware('auth')->group(function () {
   /*Inicio*/
   Route::resource('/', 'Administrator\HomeController')->names([
      'index' => 'home.index'
   ]);

   /*Usuarios*/
   Route::resource('/users', 'Administrator\UsersController');

   /*Clientes*/
   Route::resource('/clients', 'Administrator\ClientsController');

   /*Ciudades*/
   Route::resource('/cities', 'Administrator\CitiesController');
});
