<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RajaOngkirController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('raja-ongkir', RajaOngkirController::class);
Route::prefix('rajaongkir')->group(function () {
    Route::get('province', [RajaOngkirController::class, 'getProvince']);
    Route::post('check', [RajaOngkirController::class, 'checkOngkir']);
    // get List of cities by province
    Route::get('province/{province_id}/city', [RajaOngkirController::class, 'getCityProvince']);
});
