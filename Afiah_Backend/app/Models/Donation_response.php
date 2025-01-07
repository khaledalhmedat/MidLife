<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation_response extends Model
{
    use HasFactory;

    protected $table = "donation_response";

    protected $fillable = ['blood_donation_id', 'patient_id', 'donation_receipt'];

    public function blood_donation()
    {
        return $this->belongsTo(Blood_donation::class);
    }

    public function donor()
    {
        return $this->belongsTo(Patient::class);
    }
}
