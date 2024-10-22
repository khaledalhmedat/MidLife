<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "admin";

    protected $fillable = [
        'full_name',
        'password',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
}
