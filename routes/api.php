<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// User
Route::POST('/signUp', 'Auth\RegisterController@register')->name('sign.Up');
Route::POST('/signIn', 'Auth\LoginController@login')->name('sign.In');

    // Medicine Routes
    Route::resource('/medicine', 'MedicinesController')->except([
        'edit', 'create', 'show'
    ]);
    Route::GET('/medicine/{element}/{value}', 'MedicinesController@show')->name('medicine.show');

    // User Medicine Routes
    Route::resource('/userMedicine', 'UserMedicinesController')->except([
        'edit', 'create', 'show', 'index'
    ]);
    Route::GET('/userMedicine/{value}', 'UserMedicinesController@index')->name('userMedicine.index');
    Route::GET('/userMedicine/{element}/{value}/{user_id}', 'UserMedicinesController@show')->name('userMedicine.show');
    
    // Sales Routes
    Route::resource('/sale', 'SalesController')->except([
        'edit', 'create', 'show', 'index', 'update'
    ]);
    Route::GET('/sale/{time}/{value}/{user_id}', 'SalesController@show')->name('sale.show');
    Route::GET('/sale/{user_id}', 'SalesController@index')->name('sale.index');
    Route::GET('/saleMedi/{user_id}/{medicine_id}', 'SalesController@forMedicine')->name('sale.forMedicine');
