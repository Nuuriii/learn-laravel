<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;

// Register
Route::post('register',[AuthController::class,'register']);

// Login
Route::post('login',[AuthController::class,'login']);

//Data
Route::group([
    'middleware' => ['auth:sanctum']
],function(){
    //Profile
    Route::get('profile',[ProfileController::class,'profile']);
});

// Test
Route::get('/', function()
{
    return response()->json([
        'status' => true,
        'message' => 'success',
        'data' => "Hello World"
    ],200);
});
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');