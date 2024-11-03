<?php

use App\Http\Controllers\Admin\Sale\SaleController;
use App\Http\Controllers\Admin\PaymentMethod\PaymentMethodController;
use App\Http\Controllers\Admin\Tenant\TenantController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //User
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/create', [UserController::class, 'createUser'])->name('users.createUser');
        Route::get('/detail/{id}', [UserController::class, 'show'])->name('users.show');
        Route::post('/update/{id}', [UserController::class, 'updateUser'])->name('users.update');
        Route::get('/delete/{id}', [UserController::class, 'deleteUser'])->name('users.deleteUser');
        Route::post('/resetPassword/{id}', [UserController::class, 'resetPassword'])->name('users.resetPassword');
    })->name('users');

    Route::group(['prefix' => 'sales'], function () {
        Route::get('/', [SaleController::class, 'index'])->name('sales.index');
    });


    //Tenant
    Route::resource('tenants', TenantController::class);
    Route::post('tenants/{id}/toggle-status', [TenantController::class, 'toggleStatus'])->name('tenants.toggleStatus');

    //Payment methods
    Route::resource('payment-methods', PaymentMethodController::class)->names([
        'index' => 'payment_methods.index',
        'create' => 'payment_methods.create',
        'store' => 'payment_methods.store',
        'show' => 'payment_methods.show',
        'edit' => 'payment_methods.edit',
        'update' => 'payment_methods.update',
        'destroy' => 'payment_methods.destroy',
    ]);
});

require __DIR__.'/auth.php';
