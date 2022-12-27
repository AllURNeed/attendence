<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NodeScript;

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
    return view('index');
});

Route::get('in',[NodeScript::class,'in']);
Route::get('out',[NodeScript::class,'out']);
Route::get('absent',[NodeScript::class,'absent']);

Route::POST('login',[AdminController::class,'login'])->name('login');

Route::group(["middleware"=>"logout"],function(){
    
    Route::get('/Admin/logout',[AdminController::class,'logout']);

    Route::get('/dashboard',[AdminController::class,'index']);

    Route::Get('/Add',[AdminController::class,'addapi']);
    Route::POST('/add_api',[AdminController::class,'saveapi'])->name('add_api');

    Route::get('/ViewApi',[AdminController::class,'ViewApi']);

    Route::Get('/status/{id}/{cur}',[AdminController::class,'api_status']);

    Route::get('/delete/{id}',[AdminController::class,'delete']);

    Route::Get('/settting',[AdminController::class,'setting']);

    Route::POST('/setting/save',[AdminController::class,'set_setting'])->name('setting');

});



