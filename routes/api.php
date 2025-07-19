<?php

use App\Models\Venue;
use App\Models\Speaker;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventsController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\VenuesController;
use App\Http\Controllers\API\SpeakersController;
use App\Http\Controllers\API\ParticipantsController;
use App\Http\Controllers\API\UsersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[LoginController::class,'login']);
Route::post('register',[UsersController::class, 'store']);

Route::apiResource('venues', VenuesController::class);

Route::middleware('auth:sanctum')->group(function () {

Route::delete('logout',[LoginController::class,'logout']);

Route::apiResource('events', EventsController::class);

// Route::apiResource('participants', ParticipantsController::class);

Route::get('participants', [ParticipantsController::class, 'index']);
Route::post('participants', [ParticipantsController::class, 'store'])->middleware('role:admin,user');
Route::get('participants/{participant}', [ParticipantsController::class, 'show'])->middleware('role:admin,user');
Route::put('participants/{participant}', [ParticipantsController::class, 'update'])->middleware('role:admin,user');
Route::delete('participants/{participant}', [ParticipantsController::class, 'destroy'])->middleware('role:admin');

Route::apiResource('speakers', SpeakersController::class);

});
