<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', [App\Http\Controllers\HeaderController::class, 'index'])->name('layouts.header');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/layout', [App\Http\Controllers\LayoutController::class, 'index'])->name('layouts.index');

// Route::get('/room', function () {
//     return view('room');
// });

Route::get('/room', [App\Http\Controllers\UserController::class, 'index'])->name('room');
// Route::patch('/room', [App\Http\Controllers\UserController::class, 'update'])->name('room');

Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('/user/learning_time', [App\Http\Controllers\LearningTimeController::class, 'update'])->name('learning_time.update');

Route::get('/exit', function () {
    return view('exit');
});
