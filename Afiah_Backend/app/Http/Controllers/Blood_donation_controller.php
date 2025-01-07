<?php

namespace App\Http\Controllers;

use App\Repositories\Blood_donation\Blood_Donation_Repository_Interface;
use Illuminate\Http\Request;

class Blood_donation_controller extends Controller
{
    protected $donation_repository;

    public function __construct(Blood_Donation_Repository_Interface $donation_repository)
    {
        $this->donation_repository = $donation_repository;
    }

    /////////////////////////////////////////////////////////////////////

    public function store(Request $request)
    {
        $request->validate([
            'blood_type' => 'required',
            'units_needed' => 'required',
            'city' => 'required',
            'medical_report' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('medical_report')) {
            $report = $request->file('medical_report');
            $dest = 'medical_report/';

            $image = time() . '.' . $report->getClientOriginalExtension();
            $report->move($dest, $image);
        }

        $donation = $this->donation_repository->create(
            [
                'patient_id' => auth()->user()->id,
                'blood_type' => $request->blood_type,
                'units_needed' => $request->units_needed,
                'medical_report' => '/medical_report/' . $image ?? ''
            ]
        );

        return response()->json([
            'Status' => 200,
            'Message' => 'Donation requested',
            'Data' => $donation
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function approve($id)
    {
        $donation = $this->donation_repository->approve($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Donation approved',
            'Data' => $donation
        ]);
    }

    ////////////////////////////////////////////////////////////////////

    public function cancel($donation_id)
    {
        $id = auth()->user()->id;

        $donation = $this->donation_repository->cancel($donation_id, $id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Donation cancelled',
            'Data' => $donation
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function admin_cancel($donation_id)
    {
        $donation = $this->donation_repository->admin_cancel($donation_id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Donation cancelled',
            'Data' => $donation
        ]);
    }

    /////////////////////////////////////////////////////////////////////

    public function display_all()
    {
        $patient_id = auth()->user()->id;

        $donation = $this->donation_repository->display($patient_id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Display all Donations',
            'Data' => $donation
        ]);
    }

    ////////////////////////////////////////////////////////////////////

    public function add_response(Request $request)
    {

        $request->validate([
            'blood_donation_id' => 'required',
            'donation_receipt' => 'required|image',
        ]);

        $response = $this->donation_repository->response([
            'patient_id' => auth()->user()->id,
            'blood_donation_id' => $request->blood_donation_id,
            'donation _receipt' => $request->donation_receipt
        ]);

        return response()->json([
            'Status' => 200,
            'Message' => 'Response created',
            'Data' => $response
        ]);
    }

    ///////////////////////////////////////////////////////////////////

    public function my_requests()
    {
        $id = auth()->user()->id;

        $donation = $this->donation_repository->my_requests($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'My donation requests',
            'Data' => $donation
        ]);
    }

    ///////////////////////////////////////////////////////////////////

    public function my_responses($id)
    {
        $response = $this->donation_repository->my_requests($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Display responses',
            'Data' => $response
        ]);
    }

    ////////////////////////////////////////////////////////////////////

    public function responses_i_did()
    {
        $id = auth()->user()->id;

        $response = $this->donation_repository->responses_i_did($id);

        return response()->json([
            'Status' => 200,
            'Message' => 'Display responses i did',
            'Data' => $response
        ]);
    }
}
