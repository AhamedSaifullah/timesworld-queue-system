<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('test-queue', 'App\Http\Controllers\QueueController@triggerNotification');
