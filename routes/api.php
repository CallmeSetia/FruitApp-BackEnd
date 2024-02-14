<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
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
Route::middleware(['auth:licensed_users'])->post('/logout/license', [\App\Http\Controllers\Api\AuthApiController::class, 'logoutLicense']);

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

    Route::get('/product/contributor', [\App\Http\Controllers\Api\ProductApiController::class, 'indexContributor']);
    Route::post('/product/contributor', [\App\Http\Controllers\Api\ProductApiController::class, 'createContributor']);
    Route::put('/product/contributor', [\App\Http\Controllers\Api\ProductApiController::class, 'updateContributor']);
    Route::delete('/product/contributor', [\App\Http\Controllers\Api\ProductApiController::class, 'deleteContributor']);

    Route::get('/product/parameter', [\App\Http\Controllers\Api\ProductApiController::class, 'indexParameter']);
    Route::post('/product/parameter', [\App\Http\Controllers\Api\ProductApiController::class, 'createParameter']);
    Route::put('/product/parameter', [\App\Http\Controllers\Api\ProductApiController::class, 'updateParameter']);
    Route::delete('/product/parameter', [\App\Http\Controllers\Api\ProductApiController::class, 'deleteParameter']);


    Route::get('/license/manager', [\App\Http\Controllers\Api\LicenseApiController::class, 'indexLicenseManager']);
    Route::post('/license/manager', [\App\Http\Controllers\Api\LicenseApiController::class, 'createLicenseManager']);
    Route::put('/license/manager', [\App\Http\Controllers\Api\LicenseApiController::class, 'updateLicenseManager']);
    Route::delete('/license/manager', [\App\Http\Controllers\Api\LicenseApiController::class, 'deleteLicenseManager']);





//    Route::get('/product', [\App\Http\Controllers\Api\ProductApiController::class, 'indexProduct']);
//    Route::post('/product', [\App\Http\Controllers\Api\ProductApiController::class, 'createProduct']);
//    Route::put('/product', [\App\Http\Controllers\Api\ProductApiController::class, 'updateProduct']);
//    Route::delete('/product', [\App\Http\Controllers\Api\ProductApiController::class, 'deleteProduct']);



});




