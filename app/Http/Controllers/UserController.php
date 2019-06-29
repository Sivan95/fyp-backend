<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
//category -> make the string correctly **concat the string
class UserController extends Controller
{
    public function maidIndex(){
        return User::where('category','like','%1%')->get();
    }

    public function showMaid($id){
        $maid = User::where([['id',$id],['category','like','%1%']])->get();
        if(!$maid){
            return response()->json([
                'error'=>404,
                'message'=>'not found'
            ],404);
        }        
        return $maid;
    }

    public function showCustomer($id){
        $customer = User::where([['id',$id],['category','like','%2%']])->get();
        if(!$customer){
            return response()->json([
                'error'=>404,
                'message'=>'not found'
            ],404);
        }        
        return $customer;
    }

    public function store(Request $request){
        $user = new User();
        $user->fill($request->all());
        $user->save();
        return response()->json([
            'affected'=>true,
        ],200);
    }

    public function update(Request $request,$id){  //to update the category,address as well
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'error'=>404,
                'message'=>'not found',
            ],404);
        }
        $user->fill($request->all());
        $user->save();
        return response()->json([
            'affected'=>true,
        ],200);
    }

}
