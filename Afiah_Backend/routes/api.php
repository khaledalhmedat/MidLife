<?php

use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\Examination_controller;
use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/Patient_register',[Auth_controller::class,'patient_register']);
Route::post('/Patient_login',[Auth_controller::class,'patient_login']);

Route::post('/Doctor_register',[Auth_controller::class,'doctor_register']);
Route::post('/Doctor_login',[Auth_controller::class,'doctor_login']);


Route::group(["middleware" => ["auth:sanctum"]], function () 
{
    Route::get('/Profile',[Auth_controller::class,'profile']);
    Route::get('/Logout',[Auth_controller::class,'logout']);
    Route::post('/Request_examination',[Examination_controller::class,'request_examination']);
    Route::post('/Accept_examination',[Examination_controller::class,'accept_examination']);
});


