<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
    // Medicine Routes
    Route::resource('/medicine', 'MedicinesController')->except([
        'edit', 'create', 'show'
    ]);
    Route::GET('/medicine/{element}/{value}', 'MedicinesController@show');
