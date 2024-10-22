<?php

use App\Http\Controllers\Admin_controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth_controller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::post('/Register',[Auth_controller::class,'admin_register']);
Route::post('/Login',[Auth_controller::class,'admin_login']);


Route::group(["middleware" => ["auth:sanctum"]], function () 
{
    Route::get('/Profile',[Auth_controller::class,'profile']);
    Route::get('/Logout',[Auth_controller::class,'logout']);
    Route::post('/Patient_approve',[Admin_controller::class,'patient_approve']);
    Route::post('/Doctor_approve',[Admin_controller::class,'Doctor_approve']);
});


