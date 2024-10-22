<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Repositories\Admin\Admin_Repository_Interface;
use Illuminate\Http\Request;

class Admin_controller extends Controller
{
    protected $admin_repository;

    public function __construct(Admin_Repository_Interface $admin_repository)
    {
        $this->admin_repository = $admin_repository;
    }

    ///////////////////////////////////////////////////////////////////////////

    public function patient_approve(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required'
        ]);

        $patient = $this->admin_repository->find_patient($data['patient_id']);

        if(!$patient)
        {
            return response()->json([
                'Status' => 404,
                'Message' => 'Patient not found'
            ]);
        }

        $patient->is_approved = true;

        return response()->json([
            'Status' => 200,
            'Message' => 'Patient approved',
            'Data' => $patient
        ]);
    }

    //////////////////////////////////////////////////////////////////////////

    public function doctor_approve(Request $request)
    {
        $data = $request->validate([
            'doctor_id' => 'required'
        ]);

        $doctor = $this->admin_repository->find_doctor($data['doctor_id']);

        if(!$doctor)
        {
            return response()->json([
                'Status' => 404,
                'Message' => 'Doctor not found'
            ]);
        }

        $doctor->is_approved = true;

        return response()->json([
            'Status' => 200,
            'Message' => 'Doctor approved',
            'Data' => $doctor
        ]);
    }
}
