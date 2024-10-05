<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task1Controller;
use App\Http\Controllers\Task2Controller;

Route::get('/', function () {
    return redirect('/task1');
});


Route::view('/task1', 'task1')->name('task1');
Route::view('/task2', 'task2')->name('task2');


### Задача 1
Route::get('/api/task/index', [Task1Controller::class, 'index']);
Route::post('/api/task/store', [Task1Controller::class, 'store']);
Route::post('/api/login', [Task1Controller::class, 'login']);
Route::post('/api/logout', [Task1Controller::class, 'logout']);

### Задача 2
Route::get('/api/house/index', [Task2Controller::class, 'index']);


