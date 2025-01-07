<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood_donation extends Model
{
    use HasFactory;

    protected $table = "blood_donation";

    protected $fillable = [
        'patient_id',
        'blood_type',
        'units_needed',
        'status',
        'medical_report'
    ];

    public function donation_response()
    {
        return $this->hasMany(Donation_response::class, 'blood_donation_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
