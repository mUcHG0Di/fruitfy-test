<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia()->render('Welcome');
});

Route::resource('/contacts', ContactController::class);
