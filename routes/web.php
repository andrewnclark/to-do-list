<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main tasks page
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

// Task management routes
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{id}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
