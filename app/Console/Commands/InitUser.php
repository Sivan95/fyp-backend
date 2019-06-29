<?php

namespace App\Console\Commands;
use App\User;
use Illuminate\Console\Command;

class InitUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize user data';

    private $users_data=[
        [
            'name'=>'Jackson',
            'icNumber'=>'950305-02-1234',
            'email'=>'utar@gmail.com',
            'password'=>'utar',
            'phone'=>'0123456789',
            'address'=>'utar sungai long',
            'cityState'=>'Bangsar',
            'houseType'=>null,
            'category'=>'1'
        ],
        [
            'name'=>'Jack',
            'icNumber'=>'950805-02-1234',
            'email'=>'utar1@gmail.com',
            'password'=>'utar1',
            'phone'=>'0122456789',
            'address'=>'utar kampar',
            'cityState'=>'Brickfield',
            'houseType'=>'Apartment',
            'category'=>'2'
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
        foreach($this->users_data as $user_data){
            $user = new User;
            $user->name = $user_data['name'];
            $user->icNumber = $user_data['icNumber'];
            $user->email = $user_data['email'];
            $user->password = $user_data['password'];
            $user->phone = $user_data['phone'];
            $user->address = $user_data['address'];
            $user->cityState = $user_data['cityState'];
            $user->houseType = $user_data['houseType'];
            $user->category = $user_data['category'];
            $user->save();

            echo 'successful';
        }
    }
}
