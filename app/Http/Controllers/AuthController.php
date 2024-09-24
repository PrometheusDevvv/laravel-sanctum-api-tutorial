<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{

    use HttpResponses;
    public function login(LoginUserRequest $request){
       
        $request->validated($request->all());

        if(!Auth::attempt($request->only('email', 'password'))){
            return $this->error("", 'Credentils Don\' match', 200);
        }
        $user = Auth::user();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken("User_id => {$user->id}")->plainTextToken
        ]); 
        
    }

    public function register(StoreUserRequest $request){
        $request->validated($request->all());

        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        $user = User::create($request->all());
  
        
        return $this->success([
            'user' => $user,
            'token' => $user->createToken("API Token For {$user->name}")->plainTextToken
        ]);
    }

    public function logout(){
        return response()->json("THis is my Logout");
 
    }
}
