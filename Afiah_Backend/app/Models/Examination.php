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
        'doctor_id',
        'city',
        'specification_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function examination_that_checked_correctly()
    {
        return $this->hasMany(Examination_that_checked_correctly::class);
    }
}
