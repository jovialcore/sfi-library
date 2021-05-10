<?php

use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Auth;
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


Route::get('/home', [App\Http\Controllers\MainController::class, 'mainAllImages'])->name('allImages');

Route::get('/upload', [App\Http\Controllers\UploadController::class, 'index'])->name('upload');


Route::post('/submit', [App\Http\Controllers\UploadController::class, 'storeFile'])->name('uploadFile');

Route::get('/allCats', [App\Http\Controllers\categoryController::class, 'allCategory'])->name('allCats');


Route::get('/categories/show/{id}', [App\Http\Controllers\MainController::class, 'ShowCategory'])->name('showCategory');

Route::get('/pictures/show/{id}', [App\Http\Controllers\MainController::class, 'showPicture'])->name('showPicture');



