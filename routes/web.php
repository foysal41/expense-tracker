<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackerController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function(){
    Route::get('dashboard' , [TrackerController::class , 'dashboard'])->name('dashboard');
    Route::get('income', [TrackerController::class , 'income'])->name('income');
    Route::get('expense', [TrackerController::class , 'expense'])->name('expense');
    Route::get('liabilitie', [TrackerController::class , 'liabilitie'])->name('liabilitie');

    Route::get('/filter-report', [TrackerController::class, 'filter'])->name('filter.report');
});

Route::middleware('auth')->group(function(){
    Route::post('income/store', [TrackerController::class , 'storeincome'])->name('income.store');
    Route::post('expense/store', [TrackerController::class , 'storeexpense'])->name('expense.store');
    Route::post('liabilitie/store', [TrackerController::class , 'storeliabilitie'])->name('liabilitie.store');


    Route::delete('/liabilities/delete/{id}', [TrackerController::class, 'destroyLiabilitie']);

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
