<?php

namespace App\Repositories\Blood_donation;


interface Blood_Donation_Repository_Interface
{
    public function create(array $data);

    public function approve($donation_id);

    public function cancel($donation_id,$patient_id);

    public function admin_cancel($donation_id);

    public function display($patient_id);

    public function response(array $data);

    public function my_requests($patient_id);

    public function my_responses($donation_id);

    public function responses_i_did($patient_id);

}