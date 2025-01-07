<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination_that_checked_correctly extends Model
{
    use HasFactory;

    protected $table = "examination_that_checked_correctly";

    protected $fillable = [
        'doctor_id',
        'examination_id',
        'patient_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }
}
