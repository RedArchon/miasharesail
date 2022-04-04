<?php

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
Route::post('/todo-list/store', [TodoListController::class, 'store'])->name('todo-list.store');
Route::get('/todo-list/{id}', [TodoListController::class, 'show'])->name('todo-list.show');

require __DIR__.'/auth.php';
