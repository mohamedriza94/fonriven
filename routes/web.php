<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('client.dashboard.index');
});
Auth::routes();