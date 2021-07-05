<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/panel', function () {
    return view('dashboard');
})->name('dashboard');

/* Admin Operations */

Route::group([
    'middleware' => ['auth','isAdmin'],
    'prefix' => 'admin'
], function (){
    Route::get('deneme', function () {
        return 'Test';
    });
});