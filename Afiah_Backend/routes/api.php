<?php

use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\Blood_donation_controller;
use App\Http\Controllers\Examination_controller;
use App\Models\Blood_donation;
use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/Patient_register', [Auth_controller::class, 'patient_register']); //انشاء حساب للمريض 
Route::post('/Patient_login', [Auth_controller::class, 'patient_login']); //تسجيل الدخول للمريض 

Route::post('/Doctor_register', [Auth_controller::class, 'doctor_register']); //انشاء حساب للطبيب
Route::post('/Doctor_login', [Auth_controller::class, 'doctor_login']); //تسجيل دخول للطبيب 


Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::get('/Profile', [Auth_controller::class, 'profile']); //عرض الملف الشخصي للمريض و الطبيب 
    Route::post('/Edit_profile', [Auth_controller::class, 'edit']); //اضافة صورة للملف الشخصي 
    Route::get('/Logout', [Auth_controller::class, 'logout']); //تسجيل خروج للمريض و الطبيب
    Route::post('/Request_examination', [Examination_controller::class, 'request_examination']); //طلب معاينة من قبل المريض 
    Route::post('/Accept_examination', [Examination_controller::class, 'accept_examination']); //الموافقة على طلب معاينة من قبل الطبيب
    Route::get('/All_examinations', [Examination_controller::class, 'display_examinations']); //عرض جميع المعاينات للأطباء الذين من نفس المحافظة
    Route::get('/My_patients', [Examination_controller::class, 'my_patients']); //عرض جميع المعاينات التي قام الطبيب بالموافقة عليها 
    Route::get('My_examinations', [Examination_controller::class, 'display_my_examinations']); //عرض جميع المعاينات التي طلبها المريض 
    Route::get('/Accepted_examinations', [Examination_controller::class, 'display_accepted_examinations']); //عرض المعاينات التي تم قبولها للمريض
    Route::post('/Patient_complete',[Examination_controller::class,'patient_complete']); //التأكيد على المعاينة من قبل المريض
    Route::post('/Doctor_complete',[Examination_controller::class,'doctor_complete']); //التأكيد على المعاينة من قبل الطبيب
    Route::get('/Patients_completed', [Examination_controller::class, 'patient_completed']); //عرض المعاينات التي تم التأكيد عليها للمرضى 
    Route::get('/Doctor_completed', [Examination_controller::class, 'doctor_completed']); //عرض المعاينات التي تم التأكيد عليها للأطباء 
    Route::patch('/Update_examination/{id}', [Examination_controller::class, 'update']); //تعديل المعاينة من قبل المريض 
    Route::delete('/Delete_examination/{id}', [Examination_controller::class, 'cancel']); //حذف المعاينة من قبل المريض
    Route::post('/Request_donation', [Blood_donation_controller::class, 'store']); //طلب تبرع بالدم 
    Route::patch('/Cancel_doantion/{id}', [Blood_donation_controller::class, 'cancel']); //الغاء طلب التبرع بالدم
    Route::get('/Display_all_donations', [Blood_donation_controller::class, 'display_all']); //عرض طلبات التبرع للمستخدمين من نفس المحافظة 
    Route::post('/Donation_response', [Blood_donation_controller::class, 'add_response']); //استجابة لطلب تبرع بالدم
    Route::get('/My_donation_requests', [Blood_donation_controller::class, 'my_requests']); //عرض طلبات التبرع التي طلبتها 
    Route::get('/Donation_responses/{id}', [Blood_donation_controller::class, 'my_responses']); //عرض الاستجابات لطللب التبرع الذي قمت به 
    Route::get('/Display_responses_i_did', [Blood_donation_controller::class, 'responses_i_did']); //عرض الاستجابات التي قمت بها
});
