<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostsController;
use App\Http\Middleware\checkLogin;
use App\Http\Middleware\checkAdmin;

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

Route::get('/', [PostsController::class, 'index'])->name('home');
Route::get('/post/{post:slug}', [PostsController::class, 'show'])->name('showpost');

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


Route::middleware('checkLogin')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');

    Route::get('/user/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/user/updatename', [UserController::class, 'updatename'])->name('updatename');
    Route::post('/user/updatepassword', [UserController::class, 'updatepassword'])->name('updatepassword');
    Route::post('/user/updateimage', [UserController::class, 'updateimage'])->name('updateimage');
    Route::get('/user/show', [UserController::class, 'show'])->middleware('checkAdmin')->name('usershow');
    
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/addcategory', [CategoryController::class, 'store'])->name('addcategory');
    Route::get('/deletecategory/{id}', [CategoryController::class, 'destroy'])->name('deletecategory')->middleware('checkAdmin');

    Route::get('/user/addpost', [PostsController::class, 'create'])->name('addpost');
    Route::post('/user/addpost', [PostsController::class, 'store'])->name('storepost');
    Route::get('/user/allpost', [PostsController::class, 'allpost'])->name('allpost');
    Route::get('/user/ownpost', [PostsController::class, 'ownpost'])->middleware('checkAdmin')->name('ownpost');
    Route::get('/user/deletepost/{post:id}', [PostsController::class, 'delete'])->name('deletepost');
    Route::get('/user/editpost/{post:slug}', [PostsController::class, 'edit'])->name('editpost');
    Route::post('/user/updatepost/{post:slug}', [PostsController::class, 'update'])->name('updatepost');
    Route::get('/user/destroypost/{id}', [PostsController::class, 'destroy'])->name('removepost');
    Route::get('/user/restorepost/{id}', [PostsController::class, 'restore'])->name('restorepost');
    Route::get('/user/trash', [PostsController::class, 'trash'])->name('trash');
});