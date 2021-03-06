<?php

use App\Http\Controllers\Admin\CrudController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CachingMiddleware;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Voyager;

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
Route::get('http',[MainController::class,'http'])->name('http');
Route::get('serviceProvider',[MainController::class,'serviceProvider'])->name('serviceProvider');

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Route::resource('crud',CrudController::class);

    Voyager::routes();
});
