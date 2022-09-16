<?php

use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/fetchEmp', [UserController::class, 'fetchEmp'])->name('fetchEmp');
Route::post('/formSubmit', [UserController::class, 'formSubmit'])->name('formSubmit');
Route::get('/edit/{id}',[UserController::class, 'edit'])->name('edit');
Route::post('/update/{id}',[UserController::class, 'update'])->name('update');
Route::delete('/delete/{id}',[UserController::class, 'delete'])->name('delete');
