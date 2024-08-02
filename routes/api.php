<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;

// Register
Route::post('register',[AuthController::class,'register']);

// Login
Route::post('login',[AuthController::class,'login']);

//Data & Auth Access
Route::group([
    'middleware' => ['auth:sanctum']
],function(){
    //Profile
    Route::get('profile',[ProfileController::class,'profile']);

    //Add Notes
    Route::post('notes', [NoteController::class, 'addNote']);

    //Edit Notes
    Route::put('notes/edit/{id}',[NoteController::class,'editNote']);

    //Show Detail Notes
    Route::get('notes/show/{id}',[NoteController::class,'showNote']);
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