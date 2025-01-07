<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "doctor";

    protected $fillable = [
        'full_name',
        'specification_id',
        'password',
        'national_number',
        'phone',
        'city',
        'address'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function examination()
    {
        return $this->hasMany(Examination::class);
    }

    public function address_of_doctor()
    {
        return $this->belongsTo(Address_of_doctor::class);
    }

    public function specification()
    {
       return $this->belongsTo(specification::class);
    }

    public function examination_that_checked_correctly()
    {
        return $this->hasMany(Examination_that_checked_correctly::class);
    }
    
}
