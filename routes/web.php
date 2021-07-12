<?php

use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* Route::middleware(['auth:sanctum', 'verified'])->get('/panel', function () {
    return view('dashboard');
})->name('dashboard'); */

/* Main Controller Operations */
Route::middleware(['auth'])->group(function () {
    Route::get('/panel',[MainController::class,'index'])->name('dashboard');
    Route::get('quiz/{slug}',[MainController::class,'quizDetails'])->name('quiz-details');
});

/* Admin Operations */

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'], function () {
    Route::resource('quizzes', QuizController::class);
    Route::resource('quiz/{quiz_id}/questions',QuestionController::class);
});
