<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'slot_number',
        'reservation_date',
        'duration_hours',
    ];
}