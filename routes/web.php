<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'shortener.'], function () {
    Route::get('/', [UrlController::class, 'index'])->name('home');
    Route::post('/', [UrlController::class, 'createShortUrl'])->name('store');
    Route::get('/shortener', [UrlController::class, 'show'])->name('show');
    Route::get('/{shortUrl}', [UrlController::class, 'redirect'])->name('redirect');
});
