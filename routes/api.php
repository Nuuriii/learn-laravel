<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;


// Register
Route::post('register',[ApiController::class,'register']);

// Login
Route::post('login',[ApiController::class,'login']);

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