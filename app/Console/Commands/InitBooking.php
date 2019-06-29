<?php

namespace App\Console\Commands;

use App\Booking;
use Illuminate\Console\Command;

class InitBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'initialize booking data';

    private $bookings_data=[
        [
            'user_id'=> 2,
            'maid_id'=> 1,
            'services'=>'Basic HouseKeeping',
            'price'=>'100',
            'session'=>'Single Session',
            'bookingDate'=>'12/12/2019',
            'bookingTime'=>'12:00 p.m.',
            'status'=>'Accept', //Pending->waiting maid accept,Accepted, Rejected, In progress->booking status, Cancelled
            'paymentStatus'=>'Pending' //Pending, Paid
        ]
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach($this->bookings_data as $booking_data){
            $booking = new Booking;
            $booking->user_id = $booking_data['user_id'];
            $booking->maid_id = $booking_data['maid_id'];
            $booking->status = $booking_data['status'];
            $booking->services = $booking_data['services'];
            $booking->price = $booking_data['price'];
            $booking->session = $booking_data['session'];
            $booking->bookingDate = $booking_data['bookingDate'];
            $booking->bookingTime = $booking_data['bookingTime'];
            $booking->paymentStatus = $booking_data['paymentStatus'];
            $booking->save(); 

            echo 'successful';
        }
    }
}
