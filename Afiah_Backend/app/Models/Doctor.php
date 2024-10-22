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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function patient()
    {
        return $this->belongsToMany(Patient::class,'examination');
    }

    public function address_of_doctor()
    {
        return $this->belongsTo(Address_of_doctor::class);
    }

    public function specification()
    {
       return $this->belongsTo(specification::class);
    }
    
}
