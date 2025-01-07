<?php

namespace App\Repositories\Admin;


interface Admin_Repository_Interface
{
    public function find_patient($id);

    public function find_doctor($id);

    public function display_patients();

    public function display_doctors();

    public function delete_patient($id);

    public function delete_doctor($id);

    public function display_examinations();

    public function delete_examination($id);

    public function patient_search($name);

    public function doctor_search($name);

}