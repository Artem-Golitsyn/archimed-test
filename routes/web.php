<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task1Controller;

Route::view('/', 'default');
Route::view('/task1', 'task1');
Route::view('/task2', 'task2');



// Вообще тут правильно вынести в роут api.php для которго будет отдельная Middleware-группа
Route::prefix('api')->group(function () {
    Route::get('/task/index', [Task1Controller::class, 'index']);
    Route::post('/task/store', [Task1Controller::class, 'store']);
    Route::post('/login', [Task1Controller::class, 'login']);
    Route::post('/logout', [Task1Controller::class, 'logout']);
});