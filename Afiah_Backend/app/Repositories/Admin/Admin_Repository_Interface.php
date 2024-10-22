<?php

namespace App\Repositories\Admin;


interface Admin_Repository_Interface
{
    public function find_patient($id);

    public function find_doctor($id);

}