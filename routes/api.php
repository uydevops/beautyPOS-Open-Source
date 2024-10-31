<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;





Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/users', function () {
    return DB::table('users')->get();
});

Route::post('/CustomerLogin', function (Request $request) {
    $credentials = $request->only('phone', 'password');
    if (Auth::attempt($credentials)) {
        return response()->json(['message' => 'Login Successfull']);
    }
    return response()->json(['message' => 'Login Failed']);
});
