<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table='transactions';

    protected $fillable=[
        'user_id',
        'booking_id',
        'accountNumber', 
        'fees',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function booking(){
        return $this->belongsTo(Booking::class);
    }
}
