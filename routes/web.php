<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task1Controller;

Route::view('/', 'default');
Route::view('/task1', 'task1')->name('task1');
Route::view('/task2', 'task2')->name('task2');

