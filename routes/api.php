<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//Rotas que Controlam a ação dos usuários
Route::group([
    'namespace'=> 'Api',
    ],function(){

    Route::auth();
    Route::get('/users','UserController@index')->name('users');
    Route::get('/users/{id}','UserController@show')->name('users');
    Route::post('/register','UserController@register')->name('users');
    Route::post('/login','UserController@login')->name('users');
    Route::delete('/user/{id}','UserController@destroy')->name('users');
    Route::put('/user/{id}','UserController@update')->name('users');
    Route::post('/logout','UserController@logout')->name('users');
});

//Rotas que Controlam a ação dos roles

Route::get('/roles','RolesController@index')->name('roles');
Route::get('/roles/{id}','RolesController@show')->name('roles');
Route::post('roles/register','RolesController@register')->name('roles');
Route::delete('/role/{id}','RolesController@destroy')->name('roles');
Route::put('/role/{id}','RolesController@update')->name('roles');


//Rotas que Controlam a ação das escolas

Route::get('/schools','SchoolController@index')->name('schools');
Route::get('/schools/{id}','SchoolController@show')->name('schools');
Route::post('schools/register','SchoolController@register')->name('schools');
Route::delete('/school/{id}','SchoolController@destroy')->name('schools');
Route::put('/school/{id}','SchoolController@update')->name('schools');






