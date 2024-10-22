<?php

namespace App\Http\Controllers;

use App\Repositories\Examination\Examination_Repository_Interface;
use Illuminate\Http\Request;

class Examination_controller extends Controller
{
    protected $exam_repository;

    public function __construct(Examination_Repository_Interface $exam_repository)
    {
        $this->exam_repository = $exam_repository;
    }

    //////////////////////////////////////////////////////////////////////

    public function get_specification()
    {
        $exam = $this->exam_repository->get();

        return response()->json([
            'Status' => 200,
            'Message' => 'Display specifications',
            'Data' => $exam
        ]);
    }

    ///////////////////////////////////////////////////////////////////////

    public function add_specification(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $exam = $this->exam_repository->add($data);

        return response()->json([
            'Status' => 200,
            'Message' => 'Specification added',
            'Data' => $exam
        ]);
    }

    ///////////////////////////////////////////////////////////////////////

    public function request_examination(Request $request)
    {
        $request->validate([
            'description_of_status' => 'required',
        ]);

        $examination = $this->exam_repository->create([
            'patient_id' => auth()->user()->id,
            'description_of_status' => $request->report,
        ]);

        return response()->json([
            'Status' => 200,
            'Message' => 'Examination requested',
            'Data' => $examination
        ]);
    }

    //////////////////////////////////////////////////////////////////////

    public function accept_examination(Request $request)
    {
        $data = $request->validate([
            'examination_id',
            'time' => 'required|date',
        ]);

        $examination = $this->exam_repository->find_by_id($data['examination_id']);
        $examination->doctor_id = auth()->user()->id;
        $examination->time = $request->time;
        $examination->save();

        return response()->json([
            'Status' => 200,
            'Message' => 'Examination accepted',
            'Data' => $examination
        ]);
    }
    
}
