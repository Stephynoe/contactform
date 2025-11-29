<?php

use Illuminate\Support\Facades\Route;

use Stephynoe\Contactform\Http\Controllers\ContactFormController;

Route::middleware(['guest', 'web'])->group(function(){
    Route::get('/contact', [ContactFormController::class, 'create']);
    Route::post('/submit/message', [ContactFormController::class, 'store']);
});
    