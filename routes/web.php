<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

// Route::resource('employees', EmployeeController::class);
//
Route::controller(EmployeeController::class)
    ->prefix('employees')
    ->as('employees.')
    ->group(function() {
        Route::get('/index', 'index')->name('index');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::get('/create', 'create')->name('create');
        Route::get('/show', 'show')->name('show');

        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/destroy/{id}', 'destroy')->name('destroy');

    });

