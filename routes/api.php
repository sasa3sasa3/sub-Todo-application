<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;

Route::get('todos/search', [TodoController::class, 'search']);

Route::apiResource('todos', TodoController::class);

Route::apiResource('categories', CategoryController::class);
