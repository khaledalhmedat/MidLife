<?php

namespace App\Repositories\Examination;



interface Examination_Repository_Interface
{
    public function get();

    public function add($data);

    public function create(array $data);

    public function find_all();

    public function find_by_id($id);

}