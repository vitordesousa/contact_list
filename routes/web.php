<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/contacts', [App\Http\Controllers\ContactsController::class, 'index'])->name('contacts.index');
Route::get('/contacts/check-data/{data}/{type}', [App\Http\Controllers\ContactsController::class, 'checkData'])->name('contacts.checkData');
Route::resource('contacts', '\App\Http\Controllers\ContactsController')->except(['index'])->middleware('auth');
