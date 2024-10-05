<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task1Controller;
use App\Http\Controllers\Task2Controller;

### Задача 1
Route::get('/task/index', [Task1Controller::class, 'index']);
Route::post('/task/store', [Task1Controller::class, 'store']);
Route::post('/login', [Task1Controller::class, 'login']);
Route::post('/logout', [Task1Controller::class, 'logout']);

### Задача 2
Route::post('/house/index', [Task2Controller::class, 'index']);


