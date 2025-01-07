<?php

namespace App\Repositories\Blood_donation;

use App\Models\Blood_donation;
use App\Models\Donation_response;
use App\Models\Patient;

class Blood_Donation_Repository implements Blood_Donation_Repository_Interface
{
    public function create(array $data)
    {
        return Blood_donation::create($data);
    }

    ////////////////////////////////////////////////////////////

    public function approve($donation_id)
    {
        $donation = Blood_donation::findOrFail($donation_id);
        $donation->status = 'approved';
        $donation->save();
        return $donation;
    }

    /////////////////////////////////////////////////////////////

    public function cancel($donation_id, $patient_id)
    {
        $donation = Blood_donation::findOrFail($donation_id);
        $donation->status = 'cancelled';
        $donation->save();
        return $donation;
    }

    /////////////////////////////////////////////////////////////

    public function admin_cancel($donation_id)
    {
        $donation = Blood_donation::findOrFail($donation_id);
        $donation->status = 'cancelled';
        $donation->save();
        return $donation;
    }

    //////////////////////////////////////////////////////////////

    public function display($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);

        return Blood_donation::with(['patient'])->where('status', 'approved')->where('city', $patient->city)->get();
    }

    /////////////////////////////////////////////////////////////

    public function response(array $data)
    {
        return Donation_response::create($data);
    }

    /////////////////////////////////////////////////////////////

    public function my_requests($patient_id)
    {
        return Blood_donation::where('patient_id', $patient_id)->get();
    }

    /////////////////////////////////////////////////////////////

    public function my_responses($donation_id)
    {
        return Donation_response::with(['donor'])->where('id', $donation_id)->get();
    }

    ////////////////////////////////////////////////////////////

    public function responses_i_did($patient_id)
    {
        return Donation_response::with(['blood_donation'])->where('patient_id',$patient_id)->get();
    }
}
