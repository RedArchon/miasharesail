<?php

use App\Http\Controllers\TodoItemController;
use App\Http\Controllers\TodoListController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/todo-list/create', [TodoListController::class, 'create'])->name('todo-list.create');
Route::get('/todo-list/index', [TodoListController::class, 'index'])->name('todo-list.index');
Route::get('/todo-list/{id}', [TodoListController::class, 'show'])->name('todo-list.show');
Route::post('/todo-list/store', [TodoListController::class, 'store'])->name('todo-list.store');
Route::post('/todo-list/{id}/destroy', [TodoListController::class, 'destroy'])->name('todo-list.destroy');

Route::put('/todo-item/{todo_item}/update', [TodoItemController::class, 'update'])
    ->name('todo-item.update')
//    ->middleware('can:update,todo_item')
;
Route::post('/todo-item/{todo_item}/destroy', [TodoItemController::class, 'destroy'])
    ->name('todo-item.destroy')
    ->middleware('can:delete,todo_item');

require __DIR__.'/auth.php';
