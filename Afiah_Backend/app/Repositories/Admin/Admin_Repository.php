<?php

namespace App\Repositories\Admin;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Examination;
use App\Repositories\Admin\Admin_Repository_Interface;


class Admin_Repository implements Admin_Repository_Interface
{
    public function find_patient($id)
    {
        return Patient::findOrFail($id);
    }

    //////////////////////////////////////////////////////////

    public function find_doctor($id)
    {
        return Doctor::findOrFail($id);
    }

    //////////////////////////////////////////////////////////

    public function display_patients()
    {
        return Patient::all();
    }

    //////////////////////////////////////////////////////////

    public function display_doctors()
    {
        return Doctor::all();
    }

    //////////////////////////////////////////////////////////

    public function delete_patient($id)
    {
        return Patient::where('id',$id)->delete();
    }

    //////////////////////////////////////////////////////////

    public function delete_doctor($id)
    {
        return Doctor::where('id',$id)->delete();
    }

    /////////////////////////////////////////////////////////

    public function display_examinations()
    {
        return Examination::all()->with('patient','doctor');
    }

    /////////////////////////////////////////////////////////

    public function delete_examination($id)
    {
        return Examination::where('id',$id)->delete();
    }

    //////////////////////////////////////////////////////////

    public function patient_search($name)
    {
        return Patient::where('full_name','like','%' . $name . '%')->get();
    }

    /////////////////////////////////////////////////////////

    public function doctor_search($name)
    {
        return Doctor::where('full_name','like','%' . $name . '%')->get();
    }
}