<?php

use Illuminate\Support\Facades\Route;


Route::get('/clear', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return "Cleared!";

});

Route::get('/', [App\Http\Controllers\WebsiteController::class, 'home'])->name('/');
Route::get('/home', [App\Http\Controllers\WebsiteController::class, 'home'])->name('home');

// website routes
Route::namespace('Auth')->middleware('guest:web')->group(function () {
    Route::match(['get', 'post'], '/login', [App\Http\Controllers\WebsiteController::class, 'login'])->name('login');
    Route::get('register', [App\Http\Controllers\WebsiteController::class, 'register'])->name('register');
    Route::post('saveuserrecord', [App\Http\Controllers\WebsiteController::class, 'saveuserrecord'])->name('saveuserrecord');
});

Route::namespace('Auth')->middleware('auth:web')->group(function () {
    Route::get('profile', [App\Http\Controllers\WebsiteController::class, 'profile'])->name('profile');
    Route::post('updateprofile', [App\Http\Controllers\WebsiteController::class, 'updateprofile'])->name('updateprofile');
    Route::post('logout', [App\Http\Controllers\WebsiteController::class, 'logout'])->name('logout');

    //    news api
    Route::get('filter+news', [App\Http\Controllers\FilterController::class, 'filternews'])->name('filternews');

    //    open news api
    Route::get('guardiann+ews', [App\Http\Controllers\FilterController::class, 'guardiannews'])->name('guardiannews');

    //    bbc news api
    Route::get('bbc+news', [App\Http\Controllers\FilterController::class, 'bbcnews'])->name('bbcnews');
});

