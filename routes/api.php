<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    WikiController,
    WikiComment,
    UserController
};

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

Route::controller(WikiController::class)->group(function(){
    Route::get('search', 'searchAPI');
    Route::get('rating/{wiki}', 'rating');
});

Route::get('voting/{comments}', [WikiComment::class, 'vote']);

Route::controller(UserController::class)->group(function(){
    Route::prefix('user')->group(function(){
        Route::get('{user}/crown', 'toggleCrown');
    });
});
