<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;

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


Route::middleware(['middleware' => 'preventBackHistory'])->group(function ()
{
    Auth::routes();
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gitpull', [HomeController::class, 'gitpull'])->name('gitpull');

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'preventBackHistory']], function ()
{
    Route::get('dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
});

Route::group(['prefix' => 'user', 'middleware' => ['isUser', 'auth', 'preventBackHistory']], function ()
{
    Route::get('dashboard',[AdminController::class, 'index'])->name('user.dashboard');
});