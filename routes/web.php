<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Models\Crew;
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

    return view('auth.login');
})->name('login');


Route::controller(AuthController::class)
    ->group(function () {
        Route::post('login/user', 'login')->name('user.auth');
        Route::get('register', 'register')->name('register');
        Route::post('register/store', 'store')->name('user.store');
        Route::delete('user/destroy', 'destroy')->name('user.destroy');
    });


Route::controller(UserController::class)
    ->middleware('auth')
    ->group(function () {
        //navigation
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('logout', 'logout')->name('logout');
    });

Route::resource('crew', CrewController::class)->middleware('auth');

Route::controller(DocumentController::class)
    ->middleware('auth')
    ->prefix('document')
    ->group(function () {
        //navigation
        Route::get('create/{crew_id}', 'create')->name('document.create');
        Route::get('show/{crew_id}', 'show')->name('document.show');
        Route::delete('destroy/{crew_id}', 'destroy')->name('document.destroy');
        Route::get('edit/{crew_id}', 'edit')->name('document.edit');
        Route::put('update/{crew_id}', 'update')->name('document.update');
        Route::post('store/{crew_id}', 'store')->name('document.store');
    });
