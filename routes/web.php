<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/trash', [UserController::class, 'trash'])->name('users.trash');
Route::post('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
Route::post('/users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
Route::delete('/users/force-delete/{id}', [UserController::class, 'forceDelete'])->name('users.forceDelete');
Route::get('/dashboard', function () {
    return view('dashboard', [
        'total' => \App\Models\User::count(),
        'deleted' => \App\Models\User::onlyTrashed()->count(),
    ]);
});