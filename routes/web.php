<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;

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
    return view('login');
});

Route::get('login', [Authentication::class, 'login'])->name('login');
Route::get('check', [Authentication::class, 'check'])->name('check');
Route::get('home', [Authentication::class, 'home']);

Route::get('gitpull', [Authentication::class, 'gitpull']);
