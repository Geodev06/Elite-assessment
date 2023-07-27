<?php

use App\Http\Controllers\CrewController;
use App\Http\Controllers\DocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::resource('crew', CrewController::class)

    ->except(['edit', 'create']);

Route::controller(DocumentController::class)

    ->prefix('document')
    ->group(function () {
        //navigation
        Route::get('getall', 'getAll')->name('document.getall');
        Route::get('show/{crew_id}', 'show')->name('document.show');
        Route::delete('destroy/{crew_id}', 'destroy')->name('document.destroy');
        Route::get('edit/{crew_id}', 'edit')->name('document.edit');
        Route::put('update/{crew_id}', 'update')->name('document.update');
        Route::post('store/{crew_id}', 'store')->name('document.store');
    });
