<?php

use Illuminate\Support\Facades\Route;

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

// Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function () {
	Route::get('/', IndexController::class)->where('page', '.*');
	Route::get('/{page}', IndexController::class)->where('page', '.*');
});



Route::group(['namespace' => 'App\Http\Controllers\Project'], function () {
	Route::group(['namespace' => 'Product'], function () {
		Route::get('/', IndexController::class)->where('page', '.*');
		Route::get('/{page}', IndexController::class)->where('page', '.*');
	});
	Route::group(['namespace' => 'About'], function () {
		Route::get('/about', IndexController::class)->name('about');
	});
});