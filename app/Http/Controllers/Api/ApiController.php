<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $validateUser = Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if($validateUser->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ],401);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ],200);
    }
}