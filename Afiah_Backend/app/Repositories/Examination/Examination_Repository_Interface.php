<?php

namespace App\Repositories\Examination;



interface Examination_Repository_Interface
{
    public function get();

    public function add($data);

    public function create(array $data);

    public function find_by_id($id);

    public function display_all($doctor_id);

    public function display_my_patients($id);

    public function display_my_examinations($id);

    public function display_accepted_examinations($id);

    public function doctor_complete(array $data);

    public function patient_complete(array $data);

    public function doctor_completed($id);

    public function patient_completed($id);

    public function update($id,$data);

    public function cancel($id);



}