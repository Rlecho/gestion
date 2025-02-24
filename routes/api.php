<?php

use Illuminate\Routing\Middleware\SubstituteBindings;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Routes accessibles sans authentification
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Routes protégées par l'authentification
// Route::middleware(SubstituteBindings::class)->group(function (){
//     Route::get('/tasks', [TaskController::class, 'index']);
//     Route::post('/tasks', [TaskController::class, 'store']);
//     Route::get('/tasks/{task}', [TaskController::class, 'show']);
//     Route::put('/tasks/{task}', [TaskController::class, 'update']);
//     Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
//     Route::get('/tasks/status/{status}', [TaskController::class, 'filterByStatus']);
//     Route::get('/tasks/search/{title}', [TaskController::class, 'searchByTitle']);
//     Route::get('/tasks/stats', [TaskController::class, 'stats']);
// });

Route::middleware(['auth:sanctum', SubstituteBindings::class])->group(function (){
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
    Route::get('/tasks/status/{status}', [TaskController::class, 'filterByStatus']);
    Route::get('/tasks/search/{title}', [TaskController::class, 'searchByTitle']);
    Route::get('/tasks/stats', [TaskController::class, 'stats']);
});