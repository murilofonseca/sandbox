<?php

use App\Http\Controllers\api\v1\users\UsersController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::group([
            'middleware' => 'apiJWT'
        ], function ($router) {
            Route::post('/logout', [AuthController::class, 'logout'])->name('logoutApi');
            Route::post('/refresh', [AuthController::class, 'refresh']);
            Route::post('/me', [AuthController::class, 'me']);
        });
        Route::post('/login', [AuthController::class, 'login'])->name('loginApi');
    });

    Route::middleware(['apiJWT'])->group(function () {
        Route::apiresource('users', UsersController::class, [
            'names' => [
                'index' => 'indexUsersApi',
                'show' => 'showUsersApi',
                'update' => 'updateUsersApi',
                'destroy' => 'destroyUsersApi'

            ]
        ]);
    });
});
