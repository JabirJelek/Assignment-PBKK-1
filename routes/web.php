<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/store', [ItemController::class, 'store'])->name('items.store');
Route::get('/edit/{item}', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/update/{item}', [ItemController::class, 'update'])->name('items.update');
Route::delete('/delete/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
