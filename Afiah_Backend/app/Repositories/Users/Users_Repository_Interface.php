<?php

namespace App\Repositories\Users;


interface Users_Repository_Interface
{
    public function create_patient(array $data);

    public function create_doctor(array $data);

    public function find_patient($phone);

    public function find_doctor($phone);

    public function create_admin(array $data);

    public function find_admin($phone);

    public function profile();

    public function logout();

    public function edit_profile($data,$id);
}