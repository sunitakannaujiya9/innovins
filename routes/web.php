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

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'signIn'])->name('login');
Route::post('doLogin', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'signUp']);
Route::post('storeReg', [App\Http\Controllers\Auth\RegisterController::class, 'store']);

Route::group(['middleware'=>'auth'], function(){
Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
Route::resource('user_management', App\Http\Controllers\Admin\UserManagementController::class);

});