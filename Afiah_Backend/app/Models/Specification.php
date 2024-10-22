<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    protected $table = "specification";

    protected $fillable = ['name'];

    public function doctor()
    {
        return $this->hasMany(Doctor::class);
    }
}
