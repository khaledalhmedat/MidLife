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

    //////////////////////////////////////////////////////////////////////

    public function display_patients()
    {
        $admin = $this->admin_repository->display_patients();

        return response()->json([
            'Status' => 200,
            'Message' => 'Display all patients',
            'Data' => $admin
        ]);
    }

    //////////////////////////////////////////////////////////////////////

    public function display_doctors()
    {
        $admin = $this->admin_repository->display_doctors();

        return response()->json([
            'Status' => 200,
            'Message' => 'Display all doctors',
            'Data' => $admin
        ]);
    }

    //////////////////////////////////////////////////////////////////////

    public function delete_patient($id)
    {
        $admin = $this->admin_repository->delete_patient($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Patient deleted',
            'Data' => $admin
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function delete_doctor($id)
    {
        $admin = $this->admin_repository->delete_doctor($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Doctor deleted',
            'Data' => $admin
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function display_examinations()
    {
        $admin = $this->admin_repository->display_examinations();

        return response()->json([
            'Status' => 200,
            'Message' => 'Display all examinations',
            'Data' => $admin
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function delete_examinations($id)
    {
        $admin = $this->admin_repository->delete_examination($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'examination deleted',
            'Data' => $admin
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function patient_search($name)
    {
        $admin = $this->admin_repository->patient_search($name);

        return response()->json([
            'Status' => 200,
            'Message' => 'Search results',
            'Data' => $admin
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function doctor_search($name)
    {
        $admin = $this->admin_repository->doctor_search($name);

        return response()->json([
            'Status' => 200,
            'Message' => 'Search results',
            'Data' => $admin
        ]);
    }
}
