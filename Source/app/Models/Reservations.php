<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservations extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guest_id',
        'guest_name',
        'reservation_type',
        'amount',
        'check_in_date',
        'check_out_date',
        'check_in_time',
        'check_out_time',
        'rooms_amount',
        'layout',
        'room_id',
        'extra_info',
    ];

    public function room()
    {
        return $this->belongsTo(RoomsAndHalls::class, 'room_id');
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }
}
