<?php

namespace App\Http\Controllers;

use App\User;
use App\Transaction;
use App\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function maidOwnBookingDetails($id){ //maid check all booking details, except for pending
        $booking = Booking::where([['maid_id',$id],['status','!=','Rejected']])->get();
        return $booking;
    }

    public function customerOwnBookingDetails($id){ //customer get his/her own booking details
        $booking = Booking::where('user_id',$id)->get();
        return $booking;
    }

    public function show($id){ //show a full details of a booking
        $booking=Booking::find($id);
        if(!$booking){
            return response()->json([
                'error'=>404,
                'message'=>'Not found',
            ],404);
        }
        return $booking;
    }

    public function store(Request $request){ //to store the new booking details
        $count = Booking::where([['maid_id',$request->maid_id],['status','=','Pending']])->count();
        $check = Booking::where('user_id',$request->user_id)->latest()->first();
        if($count>5){ //if the maid already have more than 5 request, maid will be not available
            return response()->json([
                'affected'=>false,
                'message'=>'too many requests',
            ],200);
        }else if($check){
            if($check->status!='Cancelled'){
                return response()->json([
                    'affected'=>false,
                    'message'=>'please cancel your old request',
                ],200);
            }
        }
        $booking = new Booking();
        $booking->fill($request->all());
        $booking->paymentStatus = 'Pending';
        $booking->status = 'Pending'; //pending,accepted,rejected,in progress, cancelled
        $booking->save();

        return response()->json([
            'affected'=>true,
        ],200);
    }

    public function pendingRequest($id){ //for maid to see the pending request
        $bookings = Booking::where([['maid_id',$id],['status','Pending']])->get();
        if(!$bookings){
            return response()->json([
                'error'=>404,
                'message'=>'not found',
            ],404);
        }
        return $bookings;
    }

    public function update(Request $request,$id){  //to update booking details
        $booking = Booking::find($id);
        if(!$booking){
            return response()->json([
                'error'=>404,
                'message'=>'not found',
            ],404);
        }
        $booking->fill($request->all());
        $booking->save();
        return response()->json([
            'affected'=>true,
        ],200);
    }

    public function makePayment($id){ //to decide whether the customer can make payment or not
        $booking = Booking::find($id); //if request != accepted, customer cannot make any payment
        if(!$booking){
            return response()->json([
                'error'=>404,
                'message'=>'not found'
            ],404);
        }        
        else if($booking->status=='Accepted'){
            return response()->json([
                'affected'=>true,
            ],200);
        }

        return response()->json([
            'affected'=>false,
        ],200);
    }


}
