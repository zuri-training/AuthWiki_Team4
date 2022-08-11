<?php

use Illuminate\Support\Facades\{
    Auth,
    Route
};
use App\Http\Controllers\{
    WikiController,
    WikiComment,
    UserController,
    PageController,
    Auth\LoginController,
    FileController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);
Route::controller(LoginController::class)->group(function(){
    Route::get('/google-auth/callback', 'googleLogin');
    Route::get('/google-auth/redirect', 'redirectGoogle')->name('login.google');
    Route::get('/github-auth/callback', 'gitHubLogin');
    Route::get('/github-auth/redirect', 'redirectGithub')->name('login.github');
});
Route::controller(WikiController::class)->prefix('library')->group(function(){
    Route::get('', 'search')->name('page.library');
    Route::post('', 'searchAPI')->name('search.library');
    Route::post('{id}/rating', 'rating');
});
Route::controller(WikiComment::class)->prefix('comment')->group(function(){
    Route::post('{id}/voting', 'vote');
});
Route::controller(UserController::class)->group(function(){
    Route::post('newsletter', 'subscribe')->name('newsletter.subscribe');
    Route::get('newsletter', 'unsubscribe')->name('newsletter.unsubscribe');    

    Route::prefix('user')->group(function(){
        Route::get('{user:user_name}', 'showUserProfile');
        Route::post('{user:user_name}/crown', 'toggleCrown');
    });

    Route::get('profile', 'showProfile')->name('user.profile');
    Route::post('profile', 'updateProfile')->name('user.update');
    Route::patch('profile', 'updatePassword')->name('user.password');
    Route::delete('profile', 'deleteProfile')->name('user.delete');

    Route::get('profile/avatar', 'resetAvatar')->name('user.avatar.reset');
    Route::post('profile/avatar', 'changeAvatar')->name('user.avatar');

    Route::get('settings', 'settings')->name('user.settings');

    Route::get('terms_of_service', function(){
        return view('tos');
    })->name('page.tos');
    Route::post('terms_of_service', 'tos')->name('settings.tos');
});

Route::get('/', function () {
    if(Auth::check()) {
        return view('home');
    } else {
        return view('landing');
    }
})->name('index');

Route::get('/documentation', function(){
    return view('documentation');
})->name('page.documentation');
Route::get('/about', function(){
    return view('about');
})->name('page.about');



Route::get('/file', [FileController::class, 'create']);
Route::post('/file', [FileController::class, 'store'])->name('file.upload');