<?php

namespace App\Console\Commands;

use App\Transaction;
use App\Booking;
use Illuminate\Console\Command;

class InitTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize transactions data';

    private $transactions_data=[
        [
            'user_id'=> 2,
            'booking_id'=> 1,
            'accountNumber'=>'134294753', 
            'fees'=>'100'
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
        foreach($this->transactions_data as $transaction_data){
            $transaction = new Transaction;
            $transaction->user_id = $transaction_data['user_id'];
            $transaction->booking_id = $transaction_data['booking_id'];
            $transaction->accountNumber = $transaction_data['accountNumber'];
            $transaction->fees = $transaction_data['fees'];
            $transaction->save();

            $booking = Booking::find($transaction->booking_id);
            $booking->paymentStatus = 'Paid';
            $booking->save();   

            echo 'successful';
        }
    }
}
