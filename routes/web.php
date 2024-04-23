<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'guest'], function(){
    Route::get('/',[AuthController::class, 'login'])->name('login');
    Route::get('/register',[AuthController::class, 'register'])->name('register');
    Route::post('/register',[AuthController::class, 'newregister'])->name('register');
    Route::get('/login',[AuthController::class, 'login'])->name('login');
    Route::post('/login',[AuthController::class, 'postLogin'])->name('login');
});


Route::group(['middleware' => 'auth'], function(){
    Route::resource('article', ArticleController::class);
    Route::get('/user',[UserController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/user',[ArticleController::class, 'create'])->name('create');
    Route::get('/user/destory/{id}', [ArticleController::class, 'destory'])->name('destory');
    Route::get('/user/edit/{id}', [ArticleController::class, 'edit'])->name('edit');
    Route::post('/user/edit/{id}', [ArticleController::class, 'update'])->name('update');
    Route::delete('delete-all', [ArticleController::class, 'removeMulti']);
    Route::get('/user/profile/{usr}',[UserController::class, 'profile']);
    Route::post('/user/updateItem', [ArticleController::class, 'updateItem']);
// Route::post('/l
});
