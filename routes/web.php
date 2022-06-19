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

Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('/user/learning-time-update', [App\Http\Controllers\LearningTimeController::class, 'update'])->name('learning-time-update.update');
Route::post('/user/exit', [App\Http\Controllers\ExitController::class, 'update'])->name('exit.update');

Route::get('/room/other-list', [App\Http\Controllers\OtherUserListController::class, 'update'])->name('room.other-list');

Route::get('/exit', function () {
    return view('exit');
})->name('exit');
