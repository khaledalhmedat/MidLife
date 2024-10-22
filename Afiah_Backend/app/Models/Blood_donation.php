<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood_donation extends Model
{
    use HasFactory;

    protected $table = "blood_donation";

    protected $fillable = [
        'blood',
        'amount',
        'type_of_blood',
        'patient_id'
    ];
}
