<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Http\Middleware\checkLogin;

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
})->name('home');

Route::get('/register', [SignupController::class, 'index'])->name('register');
Route::post('/register', [SignupController::class, 'store']);
Route::get('/register/success', function () {
    return view('Register.success');
});
Route::get('activation/{token}', [SignupController::class, 'activation'])->name('activation');
Route::get('/register/active', function () {
    return view('Register.activesuccess');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/user', [UserController::class, 'index'])->middleware('checkLogin')->name('user');

Route::get('/resetmail', function () {
    return view('Password.mail');
})->name('resetmail');
Route::post('/resetmail', [PasswordController::class, 'sendmail']);
Route::get('/sendmail', function () {
    return view('Password.mailsuccess');
});
Route::get('/resetpassword/{token}', [PasswordController::class, 'resetpassword'])->name('resetpassword');
Route::post('/setpassword', [PasswordController::class, 'setPassword'])->name('setpassword');
Route::get('/resetpassword', function () {
    return view('Password.success');
});