<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/lead', function (Request $request) {
    return $request->lead();
});

Route::middleware('auth:sanctum')->get('/partner', function (Request $request) {
    return $request->partner();
});

Route::middleware('auth:sanctum')->get('/source', function (Request $request) {
    return $request->source();
});