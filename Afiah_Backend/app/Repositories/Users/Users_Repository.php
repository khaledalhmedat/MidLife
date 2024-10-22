<?php

namespace App\Repositories\Users;

use App\Models\Address_of_doctor;
use App\Models\Admin;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Users_Repository implements Users_Repository_Interface
{
    ///////////////////////////////////////////////////////////////

    public function create_patient(array $data)
    {
        return Patient::create($data);
    }

    //////////////////////////////////////////////////////////////////

    public function create_doctor(array $data)
    {
        $doctor = Doctor::create([
            'full_name' => $data['full_name'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'specification_id' => $data['specification_id'],
            'national_number' => $data['national_number'],
        ]);

        Address_of_doctor::create([
            'doctor_id' => $doctor->id,
            'street' => $data['street'],
            'governate' => $data['governate'],
            'district' => $data['district'],
            'sub_district' => $data['sub_district'],
            'community' => $data['community'],
            'details' => $data['details'],
            'city' => $data['city'],
        ]);

        return $doctor;
    }

    //////////////////////////////////////////////////////////////////

    public function find_patient($phone)
    {
        return Patient::where('phone', $phone)->first();
    }

    /////////////////////////////////////////////////////////////////

    public function find_doctor($phone)
    {
        return Doctor::where('phone', $phone)->first();
    }

    /////////////////////////////////////////////////////////////////

    public function create_admin(array $data)
    {
        return  Admin::create($data);
    }

    ////////////////////////////////////////////////////////////////

    public function find_admin($phone)
    {
        return Admin::where('phone', $phone)->first();
    }

    ////////////////////////////////////////////////////////////////

    public function profile()
    {
        return auth()->user();
    }

    ///////////////////////////////////////////////////////////////

    public function logout()
    {
        Auth::logout();
    }
}
