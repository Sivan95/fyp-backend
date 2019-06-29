<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Booking;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request){
        $transaction = new Transaction();
        $transaction->fill($request->all());
        $transaction->save();

        $booking = Booking::find($transaction->booking_id);
        $booking->paymentStatus = 'Paid';
        $booking->status = 'In Progress';
        $booking->save();

        return response()->json([
            'affected'=>true,
        ],200);
    }

    public function show($id){ //show full details of a transaction history
        $transaction=Transaction::find($id);
        if(!$transaction){
            return response()->json([
                'error'=>404,
                'message'=>'Not found',
            ],404);
        }
        return $transaction;
    }
}
