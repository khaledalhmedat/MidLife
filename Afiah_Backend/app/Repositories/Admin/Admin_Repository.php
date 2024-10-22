<?php

namespace App\Repositories\Admin;

use App\Models\Patient;
use App\Models\Doctor;
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
}