<?php

namespace App\Repositories\Examination;

use App\Models\Examination;
use App\Models\Examination_that_checked_correctly;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Specification;
use App\Repositories\Examination\Examination_Repository_Interface;


class Examination_Repository implements Examination_Repository_Interface
{
    public function get()
    {
        return Specification::all();
    }

    ////////////////////////////////////////////////////////////////

    public function add($data)
    {
        return Specification::create($data);
    }

    ////////////////////////////////////////////////////////////////

    public function create(array $data)
    {
        return Examination::create($data);
    }

    ////////////////////////////////////////////////////////////////

    public function find_by_id($id)
    {
        return Examination::findOrFail($id);
    }

    ////////////////////////////////////////////////////////////////

    public function display_all($doctor_id)
    {
        $doctor = Doctor::findOrFail($doctor_id);

        return Examination::where('specification_id', $doctor->specification_id)
            ->where('city', $doctor->city)
            ->where('doctor_id', null)->get();
    }

    ////////////////////////////////////////////////////////////////

    public function display_my_patients($id)
    {
        return Examination::where('doctor_id', $id)->with('patient')->get();
    }

    ////////////////////////////////////////////////////////////////

    public function display_my_examinations($id)
    {
        return Examination::where('patient_id', $id)->get();
    }

    /////////////////////////////////////////////////////////////////

    public function display_accepted_examinations($id)
    {
        return Examination::where('patient_id', $id)->whereNotNull('doctor_id')->with('doctor')->get();
    }

    /////////////////////////////////////////////////////////////////

    public function doctor_complete(array $data)
    {
        return Examination_that_checked_correctly::create($data);
    }

    /////////////////////////////////////////////////////////////////

    public function patient_complete(array $data)
    {
        return Examination_that_checked_correctly::create($data);
    }

    ////////////////////////////////////////////////////////////////

    public function doctor_completed($id)
    {
        return Examination_that_checked_correctly::where('doctor_id', $id)->with(['examination', 'patient']);
    }

    ////////////////////////////////////////////////////////////////

    public function patient_completed($id)
    {
        return Examination_that_checked_correctly::where('patient_id', $id)->with(['examination', 'doctor']);
    }

    ////////////////////////////////////////////////////////////////

    public function update($id, $data)
    {
        return Examination::where('id', $id)->update($data);
    }

    ////////////////////////////////////////////////////////////////

    public function cancel($id)
    {
        return Examination::where('id', $id)->where('doctor_id',null)->delete();
    }

    //////////////////////////////////////////////////////////////

}
