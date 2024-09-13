<?php

use App\Mail\UserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('product',\App\Http\Controllers\Api\ProductController::class)->middleware('auth:sanctum');

Route::post('send-mail',function (Request $request){
    \App\Jobs\UserMailJob::dispatch($request->email,$request->mail);
    return response()->json(['message'=>'Mail Sent']);
})->middleware('auth:sanctum');;

Route::prefix('auth')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
});

