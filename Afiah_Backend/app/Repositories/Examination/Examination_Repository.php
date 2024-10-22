<?php

namespace App\Repositories\Examination;

use App\Models\Examination;
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

    public function find_all()
    {
        return Examination::all();
    }

    ////////////////////////////////////////////////////////////////

    public function find_by_id($id)
    {
        return Examination::findOrFail($id);
    }
}