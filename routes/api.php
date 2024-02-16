<?php

//use App\Http\Controllers\APIController;
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

Route::middleware(['auth:api'])->post('/logout/admin', [\App\Http\Controllers\Api\AuthApiController::class, 'logoutAdmin']);
//Route::middleware(['auth:licensed_users'])->post('/logout/license', [\App\Http\Controllers\Api\AuthApiController::class, 'logoutLicense']);

Route::post('/login/{type}', [\App\Http\Controllers\Api\AuthApiController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user/admin', [\App\Http\Controllers\Api\UserAdminApiController::class, 'index']);
    Route::get('/user/admin/self', [\App\Http\Controllers\Api\UserAdminApiController::class, 'indexSelf']);
    Route::post('/user/admin', [\App\Http\Controllers\Api\UserAdminApiController::class, 'createAdmin']);
    Route::put('/user/admin', [\App\Http\Controllers\Api\UserAdminApiController::class, 'updateAdmin']);
    Route::delete('/user/admin', [\App\Http\Controllers\Api\UserAdminApiController::class, 'deleteAdmin']);

    Route::get('/product', [\App\Http\Controllers\Api\ProductApiController::class, 'indexProduct']);
    Route::post('/product', [\App\Http\Controllers\Api\ProductApiController::class, 'createProduct']);
    Route::put('/product', [\App\Http\Controllers\Api\ProductApiController::class, 'updateProduct']);
    Route::delete('/product', [\App\Http\Controllers\Api\ProductApiController::class, 'deleteProduct']);


});




