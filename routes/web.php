<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

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


Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Auth::routes();
});



Route::group(['middleware' => ['isUser', 'auth', 'PreventBackHistory']], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::get('/Transaction', [TransactionController::class, 'index']);
    Route::post('/Item/Add', [UserController::class, 'addItem']);
    Route::post('/Invoice/Add', [UserController::class, 'addinvoice']);
    Route::post('/Inventory/edit', [UserController::class, 'inventoryedit']);

    //Settings
    Route::get('/Settings', [CategoryController::class, 'index']);
    Route::post('/Settings/Category/add', [CategoryController::class, 'addCategory']);

    //JQueryJob
    Route::get('/Sells/{id}', [UserController::class, 'sells']);
});
