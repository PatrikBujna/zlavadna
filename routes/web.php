<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPageController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserPageController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserPageController::class, 'create'])->name('users.create');
    Route::post('/users', [UserPageController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserPageController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserPageController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserPageController::class, 'destroy'])->name('users.destroy');
});
