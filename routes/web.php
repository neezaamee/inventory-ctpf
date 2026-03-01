<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalItems = App\Models\ItemVariation::sum('stock_quantity');
    $totalCategories = App\Models\Category::count();
    $totalOfficers = App\Models\Officer::count();
    $recentTransactions = App\Models\Transaction::count();
    $recentActivities = App\Models\Transaction::with(['officer', 'itemVariation.item'])->latest()->take(5)->get();

    // Low Stock Alerts Logic
    $lowStockItems = App\Models\ItemVariation::with('item')
        ->whereHas('item', function($query) {
            $query->whereRaw('item_variations.stock_quantity <= items.min_stock_threshold');
        })
        ->get();

    return view('dashboard', compact('totalItems', 'totalCategories', 'totalOfficers', 'recentTransactions', 'lowStockItems', 'recentActivities'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Inventory routes (Require manage-inventory permission)
    Route::group(['middleware' => ['permission:manage-inventory']], function () {
        Route::resource('categories', App\Http\Controllers\CategoryController::class);
        Route::resource('items', App\Http\Controllers\ItemController::class);
        Route::resource('item-variations', App\Http\Controllers\ItemVariationController::class);
    });

    // Officer routes (Require manage-officers permission)
    Route::group(['middleware' => ['permission:manage-officers']], function () {
        Route::resource('officers', App\Http\Controllers\OfficerController::class);
    });
    
    // Custom Transaction Routes (Require manage-transactions permission)
    Route::group(['middleware' => ['permission:manage-transactions']], function () {
        Route::get('transactions/issued', [App\Http\Controllers\TransactionController::class, 'issuedItems'])->name('transactions.issued');
        Route::get('transactions/create-in', [App\Http\Controllers\TransactionController::class, 'createIn'])->name('transactions.create_in');
        Route::get('transactions/create-out', [App\Http\Controllers\TransactionController::class, 'createOut'])->name('transactions.create_out');
        Route::get('transactions/create-return', [App\Http\Controllers\TransactionController::class, 'createReturn'])->name('transactions.create_return');
        Route::resource('transactions', App\Http\Controllers\TransactionController::class)->except(['edit', 'update', 'destroy', 'create']);
    });

    // Reports routes (Require view-reports permission)
    Route::group(['middleware' => ['permission:view-reports']], function () {
        Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/inventory-status', [App\Http\Controllers\ReportController::class, 'inventoryStatus'])->name('reports.inventory_status');
        Route::get('/reports/transaction-history', [App\Http\Controllers\ReportController::class, 'transactionHistory'])->name('reports.transaction_history');
    });

    // User & RBAC routes (Require super-admin role)
    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    });
});

require __DIR__.'/auth.php';
