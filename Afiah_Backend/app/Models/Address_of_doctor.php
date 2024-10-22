<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address_of_doctor extends Model
{
    use HasFactory;

    protected $table = "address_of_doctor";

    protected $fillable = [
        'street',
        'city',
        'governate',
        'district',
        'sub_district',
        'community',
        'doctor_id',
        'details'
    ];

    public function doctor()
    {
        return $this->hasMany(Doctor::class);
    }
}
