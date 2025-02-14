<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
   use HasFactory;
   protected $fillable = ['license_plate', 'brand', 'model', 'year'];

    public function insurance()
    {
        return $this->hasOne(Insurance::class);
    }
}

