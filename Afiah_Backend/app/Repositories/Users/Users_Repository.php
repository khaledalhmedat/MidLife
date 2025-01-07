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
            'city' => $data['city'],
            'address' => $data['address']
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

    //////////////////////////////////////////////////////////////

    public function edit_profile($data , $id)
    {
        $patient = Patient::where('id',$id);

        $patient->image = $data;

        return null;

    }
}
