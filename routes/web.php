<?php

use App\Http\Controllers\ExternalAuth\FacebookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserManagement\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
//     return redirect()->to('login');
// });

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('redirectToGoogle');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');

Route::controller(FacebookController::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback')->name('handleFacebookCallback');
});

// Auth::routes(['register', false]);

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('spending', App\Http\Controllers\PengeluaranController::class)->except('show', 'update', 'create');
    Route::post('pengeluaran/import', [App\Http\Controllers\PengeluaranController::class, 'import'])->name('pengeluaran.import');
    Route::get('pengeluaran/export', [App\Http\Controllers\PengeluaranController::class, 'export'])->name('pengeluaran.export');

    Route::resource('spending-categories', App\Http\Controllers\CategoryController::class)->except(['show', 'update']);

    // User Management
    Route::prefix('user-management')->as('user-management.')->group(function(){
        Route::resource('role', RoleController::class)->except('update', 'create');
        Route::post('role-permission/{id}', App\Http\Controllers\UserManagement\RolePermissionController::class)->name('set-role-permission'); 
        Route::resource('user', App\Http\Controllers\UserManagement\UserController::class)->except('create');
    });

    // Pemasukan
    Route::resource('income', App\Http\Controllers\IncomeController::class)->except(['show', 'update', 'create']);
    Route::post('income/import', App\Http\Controllers\Pmasukan\ImportPemsaukanController::class)->name('income.import');
    Route::get('income/export', App\Http\Controllers\Pmasukan\ExportPemsaukanController::class)->name('income.export');

    // Kateogri Pemasukan
    Route::resource('income-categories', App\Http\Controllers\IncomeCategoryController::class)->except(['show', 'update', 'create']);

    // Pricing
    Route::resource('pricing', App\Http\Controllers\PricingController::class)->except(['show', 'update', 'create']);
});
