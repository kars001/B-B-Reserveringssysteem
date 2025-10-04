<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomsAndHalls extends Model
{
    protected $fillable = [
        'name',
        'type',
        'capacity',
        'price',
        'floor',
        'room_type',
    ];
}
