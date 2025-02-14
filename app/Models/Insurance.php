<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
use HasFactory;
    protected $fillable = ['vehicle_id', 'insurance_company', 'expiration_date'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
