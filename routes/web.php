<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\TransactionLogController;


Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');
Route::resource('business', BusinessController::class);
Route::resource('user', UserController::class);
Route::resource('counter', CounterController::class);
Route::resource('ticket', TicketController::class);
Route::resource('transactionlog', TransactionLogController::class);
Route::get('businesses/{id}', [TicketController::class, 'getBusinesses'])->name('business');
Route::get('counters/{id}', [TicketController::class, 'getCounters'])->name('counter');
