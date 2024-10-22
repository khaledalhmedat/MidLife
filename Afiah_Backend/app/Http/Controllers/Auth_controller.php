<?php

namespace App\Http\Controllers;

use App\Repositories\Users\Users_Repository_Interface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Auth_controller extends Controller
{
    protected $user_repository;

    public function __construct(Users_Repository_Interface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    ////////////////////////////////////////////////////////////////////////////

    public function patient_register(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required',
            'phone' => 'required|unique:patient',
            'city' => 'required',
            'street' => 'required',
            'martial_status' => 'required',
            'national_number' => 'required|unique:patient',
            'password' => 'required|confirmed|min:8'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = $this->user_repository->create_patient($data);

        return response()->json([
            'Status' => 200,
            'Message' => 'User registered',
            'Data' => $user
        ]);
    }

    ////////////////////////////////////////////////////////////////////////

    public function patient_login(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $user = $this->user_repository->find_patient($data['phone']);

        if (!$user) {
            return response()->json([
                'Status' => 404,
                'Message' => 'User not found'
            ]);
        }

        if (!$user->is_approved) {
            return response()->json([
                'Status' => 403,
                'Message' => 'Not approved yet'
            ]);
        }

        if (!Hash::check($data['password'], $user->password)) {
            return response()->json([
                'Status' => 401,
                'Message' => 'Wrong password'
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'Status' => 200,
            'Message' => 'User logged in',
            'Data' => $user,
            'Token' => $token
        ]);
    }

    ///////////////////////////////////////////////////////////////////

    public function admin_register(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required',
            'phone' => 'required|unique',
            'password' => 'required|confirmed|min:8',
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = $this->user_repository->create_admin($data);

        return response()->json([
            'Status' => 200,
            'Message' => 'Admin registered',
            'Data' => $user
        ]);
    }

    ////////////////////////////////////////////////////////////////////

    public function admin_login(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $user = $this->user_repository->find_admin($data['phone']);

        if (!$user) {
            return response()->json([
                'Status' => 404,
                'Message' => 'Admin not found'
            ]);
        }

        if (!Hash::check($data['password'], $user->password)) {
            return response()->json([
                'Status' => 401,
                'Message' => 'Wrong password'
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'Status' => 200,
            'Message' => 'Admin logged in',
            'Data' => $user,
            'Token' => $token
        ]);
    }

    /////////////////////////////////////////////////////////////////

    public function doctor_register(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required',
            'phone' => 'required|unique:doctor',
            'password' => 'required|confirmed|min:8',
            'national_number' => 'required|unique:doctor',
            'specification_id' => 'required',
            'street' => 'required',
            'governate' => 'required',
            'district' => 'required',
            'sub_district' => 'required',
            'community' => 'required',
            'city' => 'required',
            'details' => 'required'
        ]);

        $user = $this->user_repository->create_doctor($data);

        return response()->json([
            'Status' => 200,
            'Message' => 'Doctor registered',
            'data' => $user
        ]);
    }

    ////////////////////////////////////////////////////////////////

    public function doctor_login(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $user = $this->user_repository->find_doctor($data['phone']);

        if (!$user) {
            return response()->json([
                'Status' => 404,
                'Message' => 'Doctor not found'
            ]);
        }

        if (!$user->is_approved) {
            return response()->json([
                'Status' => 403,
                'Message' => 'Not approved yet'
            ]);
        }

        if (!Hash::check($data['password'], $user->password)) {
            return response()->json([
                'Status' => 401,
                'Message' => 'Wrong password'
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'Status' => 200,
            'Message' => 'Doctor logged in',
            'Data' => $user,
            'Token' => $token
        ]);
    }

    /////////////////////////////////////////////////////////////

    public function profile()
    {
        $user = $this->user_repository->profile();

        return response()->json([
            'Status' => 200,
            'Message' => 'Profile details',
            'Data' => $user
        ]);
    }

    /////////////////////////////////////////////////////////////

    public function logout()
    {
        $user = $this->user_repository->logout();

        return response()->json([
            'Status' => 200,
            'Message' => 'logged out',
            'Data' => $user
        ]);
    }
}


//o.get();
//o->get();
//int x
