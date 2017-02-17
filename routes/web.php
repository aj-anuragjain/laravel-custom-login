<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/user/register", function (){
    return view("auth.register");
});

Route::get("/user/login", function (){
    return view("auth.login");
});

Route::get("/user/forget", function (){
    return view("auth.forget");
});

Route::get("/user/reset", function (){
    return view("auth.reset");
});


Route::post("/user/register",  ["as" => "register", "uses" => "RegisterController@index"]);
Route::post("/user/login",  ["as" => "login", "uses" => "LoginController@index"]);





Route::get("/user/profile", "profileController@show");
Route::get("/user/logout", "LogoutController@index");

