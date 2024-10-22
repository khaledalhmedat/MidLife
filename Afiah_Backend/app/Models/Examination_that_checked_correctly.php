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
}
