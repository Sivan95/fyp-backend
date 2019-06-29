<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'maid_id',
        'services',
        'price',
        'session',
        'bookingDate',
        'bookingTime',
        'paymentStatus',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transaction(){
        return $this->hasOne(Transaction::class);
    }
}
