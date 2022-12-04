<?php

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

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
// Route::get('/', function () {
//     return view('home');
// });

Route::group(['prefix'=>'','controller'=>\App\Http\Controllers\FavoriteController::class],function(){
    Route::name('')->group(function(){
        Route::get('/favorite','saveFavorite')->name('');
    });
});


Route::get('/prueba', function(){
    return User::with('favorite')->get();
});

Route::group(['prefix'=>'','controller'=>\App\Http\Controllers\UserController::class],function(){
    Route::name('')->group(function(){
        Route::get('/','login')->name('');
        Route::get('/register','register')->name('');
        Route::post('/save','store')->name('');
        Route::get('/home','index')->name('');
        Route::get('/user/{person}','edit');
        Route::post('/user/{person}','update');
    });
});

Route::group(['prefix'=>'/sign','controller'=>\App\Http\Controllers\LoginController::class],function(){
    Route::name('')->group(function(){
        Route::post('/login','login')->name('');
        Route::post('/logout','logout')->name('');
    });
});
