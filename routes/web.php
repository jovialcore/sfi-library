<?php

use Illuminate\Support\Facades\Route;



use Illuminate\Http\Request;


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

Route::get('/pages', function () {
    return view('page');
})->name('page');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/upload', [App\Http\Controllers\UploadController::class, 'index'])->name('upload');


Route::post('/submit', [App\Http\Controllers\UploadController::class, 'storeFile'])->name('uploadFile');

Route::post('/storeCat', [App\Http\Controllers\category::class, 'storeCategory'])->name('storecategory');
