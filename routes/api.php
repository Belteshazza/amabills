<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\ProductController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthUserController::class, 'register']);

Route::post('/login', [AuthUserController::class, 'login']);



Route::middleware('auth:api')->post('/createProduct', [ProductController::class, 'createProduct']);

Route::middleware('auth:api')->put('/updateProduct/{id}', [ProductController::class, 'updateProduct']);


Route::middleware('auth:api')->get('/logout', [AuthUserController::class, 'logout']);
