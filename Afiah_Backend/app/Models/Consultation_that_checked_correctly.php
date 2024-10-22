<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation_that_checked_correctly extends Model
{
    use HasFactory;

    protected $table = "consultation_that_checked_correctly";

    protected $fillable = [
        'doctor_id',
        'consultation_id',
        'patient_id'
    ];
}
