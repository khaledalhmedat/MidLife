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
            'specification_id' => 'required',
            'city' => 'required',
            'notes',
            'report' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'sick_history',
            'surgical_history',
            'medications_taken',
            'history_of_drug_allergy',
        ]);

        if ($request->hasFile('report')) {
            $report = $request->file('report');
            $dest = 'report/';

            $image = time() . '.' . $report->getClientOriginalExtension();
            $report->move($dest, $image);
        }

        $examination = $this->exam_repository->create([
            'patient_id' => auth()->user()->id,
            'description_of_status' => $request->description_of_status,
            'notes' => $request->notes,
            'specification_id' => $request->specification_id,
            'sick_history' => $request->sick_history,
            'surgical_history' => $request->surgical_history,
            'medications_taken' => $request->medications_taken,
            'history_of_drug_allergy' => $request->history_of_drug_allergy,
            'city' => $request->city,
            'report' => '/report/' . $image ?? ''
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
            'examination_id' => 'required',
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

    //////////////////////////////////////////////////////////////////////

    public function display_examinations()
    {
        $id = auth()->user()->id;

        $examination = $this->exam_repository->display_all($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Display examinations',
            'Data' => $examination
        ]);
    }

    ///////////////////////////////////////////////////////////////////////

    public function my_patients()
    {
        $id = auth()->user()->id;

        $examination = $this->exam_repository->display_my_patients($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Display my patients',
            'Data' => $examination
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function display_my_examinations()
    {
        $id = auth()->user()->id;

        $examination = $this->exam_repository->display_my_examinations($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Display my examination',
            'Data' => $examination
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function display_accepted_examinations()
    {
        $id = auth()->user()->id;

        $examination = $this->exam_repository->display_accepted_examinations($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Display my accepted examinations',
            'Data' => $examination
        ]);
    }

    //////////////////////////////////////////////////////////////////////

    public function doctor_complete(Request $request)
    {
        $request->validate([
            'examination_id' => 'required',
            'time' => 'required'
        ]);

        $examination = $this->exam_repository->doctor_complete([
            'doctor_id' => auth()->user()->id,
            'examination_id' => $request->examination_id,
            'time' => $request->time
        ]);

        return response()->json([
            'Status' => 200,
            'Message' => 'Examination completed',
            'Data' => $examination
        ]);
    }

    ///////////////////////////////////////////////////////////////////////

    public function patient_complete(Request $request)
    {
        $request->validate([
            'examination_id' => 'required'
        ]);

        $examination = $this->exam_repository->patient_complete([
            'patient_id' => auth()->user()->id,
            'examination_id' => $request->examination_id
        ]);

        return response()->json([
            'Status' => 200,
            'Message' => 'Examination completed',
            'Data' => $examination
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function doctor_completed()
    {
        $id = auth()->user()->id;

        $examination = $this->exam_repository->doctor_completed($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Display completed examinations',
            'Data' => $examination
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function patient_completed()
    {
        $id = auth()->user()->id;

        $examination = $this->exam_repository->patient_completed($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Display completed examinations',
            'Data' => $examination
        ]);
    }

    //////////////////////////////////////////////////////////////////////

    public function update(Request $request, $id)
    {
        $request->validate([
            'description_of_status' => 'required',
            'report' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($request->hasFile('report')) {
            $report = $request->file('report');
            $dest = 'report/';

            $image = time() . '.' . $report->getClientOriginalExtension();
            $report->move($dest, $image);
        }

        $examination = $this->exam_repository->update($id, [
            'description_of_status' => $request->description_of_status,
            'report' => '/report/' . $image ?? ''
        ]);

        return response()->json([
            'Status' => 200,
            'Message' => 'Examination updated',
            'Data' => $examination
        ]);
    }

    ///////////////////////////////////////////////////////////////////////

    public function cancel($id)
    {
        $examination = $this->exam_repository->cancel($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Examination deleted',
            'Data' => $examination
        ]);
    }
}
