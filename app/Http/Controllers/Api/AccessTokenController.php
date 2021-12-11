<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PhoneVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AccessTokenController extends Controller
{
    protected $user;
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'device_name' => ['required']
        ]);

        $user = User::where('email', $request->username)
        ->orWhere('phone', $request->username)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return  response()->json(['message' => 'your password and username not correct'],
             401);
        }
        $this->user = $user;
        if($user->phone_verified_at == null){
           return $this->sendCodeVerification($user);
        }else{

            $token = $user->createToken($request->device_name);
            
            return  response()->json([
                'token' => $token->plainTextToken,
                'user' =>  $user
            ], 200);
        }

    }
    public function sendCodeVerification(User $user )
    {
        $code = rand(1111,9999);
        PhoneVerification::Create([
            'user_id' => $user->id,
            'code' => $code,
        ])->save();

        event('sendCodeVerification', [$user , $code]);
        return $code;
    }
    // o3Ntcf85me5AJhZy3FJi9JWHy1Q9eeHQZuY7iHr2
    public function CheckVerificationCode(Request $request)
    {
        // $request->validate([
        //     'user_id' => 'required',
        //     'code' => 'required',
        //     'device_name' => 'required'
        // ]);

        $user = PhoneVerification::where('user_id' , $request->user_id)
        ->where('code', $request->code)->orderBy('created_at', 'desc')->first();
        // return $request;
        if(!$user){
            return response()->json([
                'message' => 'Not Auth'
            ]);
        }else{
            $user =  User::where('id', $request->user_id)->first();
            // return now();
            $user->update(['phone_verified_at' => Carbon::now()]);
            PhoneVerification::where('user_id', $request->user_id)->delete();
             $token = $user->createToken($request->device_name);
            
            return  response()->json([
                'token' => $token->plainTextToken,
                'user' =>  $user
            ], 200);
        }
    }
}   
