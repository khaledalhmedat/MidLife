<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Patient as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "patient";

    protected $fillable = [
        'full_name',
        'martial_status',
        'password',
        'national_number',
        'phone',
        'city',
        'street'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function doctor()
    {
        return $this->belongsToMany(Doctor::class,'examination');
    }
}
