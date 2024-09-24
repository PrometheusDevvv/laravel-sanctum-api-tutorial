<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class AuthController extends Controller
{

    use HttpResponses;
    public function login(){
        return response()->json([
            'data' => User::all()
        ]);
    }

    public function register(){
        return response()->json("THis is my register");
    }

    public function logout(){
        return response()->json("THis is my Logout");
 
    }
}
