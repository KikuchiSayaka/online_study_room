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

Auth::routes();

Route::get('/room', [App\Http\Controllers\UserController::class, 'index'])->name('room');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');

Route::post('/user/learning-time-update', [App\Http\Controllers\LearningTimeController::class, 'update'])->name('learning-time-update.update');

Route::post('/user/record', [App\Http\Controllers\ExitController::class, 'update'])->name('exit.update');

Route::post('/exit', [App\Http\Controllers\ExitController::class, 'index'])->name('exit.index');


Route::get('/room/other-list', [App\Http\Controllers\OtherUserListController::class, 'update'])->name('room.other-list');

Route::get('/my-page', [App\Http\Controllers\RecordController::class, 'index'])->name('my-page');

Route::post('/user/name-change', [App\Http\Controllers\UserController::class, 'nameChange'])->name('user.name-change');
Route::post('/user/email-change', [App\Http\Controllers\UserController::class, 'emailChange'])->name('user.email-change');
Route::post('/user/password-change', [App\Http\Controllers\UserController::class, 'passwordChange'])->name('user.password-change');
