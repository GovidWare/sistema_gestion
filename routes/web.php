<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resources(['tasks'=> TaskController::class]);

    Route::get('/all/tasks', [TaskController::class,'allTasks'])->name('all.tasks');
    Route::get('file/download/{task}', [TaskController::class,'download'])->name('file.download');

    Route::get('tasks/completed/{task}', [TaskController::class,'completed'])->name('tasks.completed');
    Route::get('download/report', [TaskController::class,'downloadReport'])->name('download.report');
});

