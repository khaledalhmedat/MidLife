<?php

use App\Http\Controllers\Admin_controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\Blood_donation_controller;

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
    Route::post('/Doctor_approve',[Admin_controller::class,'doctor_approve']);
    Route::get('/Display_patients',[Admin_controller::class,'display_patients']);
    Route::get('/Display_doctors',[Admin_controller::class,'display_doctors']);
    Route::delete('/Delete_patient/{id}',[Admin_controller::class,'delete_patient']);
    Route::delete('/Delete_doctor/{id}',[Admin_controller::class,'delete_doctor']);
    Route::get('/Display_examinations',[Admin_controller::class,'display_examinations']);
    Route::get('/Search_for_patient/{name}',[Admin_controller::class,'patient_search']);
    Route::get('/Search_for_doctor/{name}',[Admin_controller::class,'doctor_search']);
    Route::patch('/Approve_donation/{id}',[Blood_donation_controller::class,'approve']);
    Route::patch('/Cancel_doantion/{id}',[Blood_donation_controller::class,'admin_cancel']);
});


