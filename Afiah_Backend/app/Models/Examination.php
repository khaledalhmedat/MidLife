<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $table = "examination";

    protected $fillable = [
        'report',
        'description_of_status',
        'patient_id',
        'doctor_id'
    ];
}
