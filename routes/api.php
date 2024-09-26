<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products',     ProductController::class);
Route::apiResource('suppliers',    SupplierController::class);

Route::post('auth/register',    [AuthController::class, 'register']);
Route::post('auth/login',       [AuthController::class, 'login']);
Route::post('auth/logout',      [AuthController::class, 'logout'])->middleware('auth:sanctum');
