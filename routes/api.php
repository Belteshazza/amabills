<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PasswordResetController;

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

Route::post('/forgot', [PasswordResetController::class, 'forgot']);

Route::post('/verifyToken', [PasswordResetController::class, 'verifyToken']);

Route::post('/resetPassword', [PasswordResetController::class, 'resetPassword']);

Route::middleware('auth:api')->post('/createProduct', [ProductController::class, 'createProduct']);

Route::middleware('auth:api')->put('/updateProduct/{id}', [ProductController::class, 'updateProduct']);

Route::middleware('auth:api')->delete('/deleteProduct/{id}', [ProductController::class, 'deleteProduct']);

Route::middleware('auth:api')->get('/allProduct', [ProductController::class, 'allProduct']);

Route::middleware('auth:api')->get('/logout', [AuthUserController::class, 'logout']);



