<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SudokuController;

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

Route::get('/', [SudokuController::class, 'display'])->name('display');

Route::get('/submit', [SudokuController::class, 'submit'])->name('submit');

Route::get('/solve', [SudokuController::class, 'solve'])->name('solve');
