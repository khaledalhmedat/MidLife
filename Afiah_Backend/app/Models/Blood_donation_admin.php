<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood_donation_admin extends Model
{
    use HasFactory;

    protected $table = "blood_donamtion_admin";

    protected $fillable = [
        'admin_id'
    ];
}
