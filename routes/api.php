<?php

use App\Http\Controllers\Api\AuditLogsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\PurchasesController;
use App\Http\Controllers\Api\ReportsController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\StockAdjustmentsController;
use App\Http\Controllers\Api\StockMovementsController;
use App\Http\Controllers\Api\StockTransfersController;
use App\Http\Controllers\Api\SuppliersController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\WarehousesController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('auth/logout', [AuthController::class, 'logout']);
        Route::get('auth/me', [AuthController::class, 'me']);

        Route::middleware('permission:users.manage')->apiResource('users', UsersController::class);
        Route::middleware('permission:roles.manage')->apiResource('roles', RolesController::class)->except(['show']);

        Route::middleware('permission:categories.view')->group(function () {
            Route::get('categories', [CategoriesController::class, 'index']);
            Route::get('categories/{category}', [CategoriesController::class, 'show']);
        });
        Route::middleware('permission:categories.manage')->group(function () {
            Route::post('categories', [CategoriesController::class, 'store']);
            Route::put('categories/{category}', [CategoriesController::class, 'update']);
            Route::delete('categories/{category}', [CategoriesController::class, 'destroy']);
        });

        Route::middleware('permission:products.view')->group(function () {
            Route::get('products', [ProductsController::class, 'index']);
            Route::get('products/{product}', [ProductsController::class, 'show']);
        });
        Route::middleware('permission:products.manage')->group(function () {
            Route::post('products', [ProductsController::class, 'store']);
            Route::put('products/{product}', [ProductsController::class, 'update']);
            Route::delete('products/{product}', [ProductsController::class, 'destroy']);
        });

        Route::middleware('permission:warehouses.view')->group(function () {
            Route::get('warehouses', [WarehousesController::class, 'index']);
            Route::get('warehouses/{warehouse}', [WarehousesController::class, 'show']);
        });
        Route::middleware('permission:warehouses.manage')->group(function () {
            Route::post('warehouses', [WarehousesController::class, 'store']);
            Route::put('warehouses/{warehouse}', [WarehousesController::class, 'update']);
            Route::delete('warehouses/{warehouse}', [WarehousesController::class, 'destroy']);
        });

        Route::middleware('permission:suppliers.view')->group(function () {
            Route::get('suppliers', [SuppliersController::class, 'index']);
            Route::get('suppliers/{supplier}', [SuppliersController::class, 'show']);
        });
        Route::middleware('permission:suppliers.manage')->group(function () {
            Route::post('suppliers', [SuppliersController::class, 'store']);
            Route::put('suppliers/{supplier}', [SuppliersController::class, 'update']);
            Route::delete('suppliers/{supplier}', [SuppliersController::class, 'destroy']);
        });

        Route::middleware('permission:customers.view')->group(function () {
            Route::get('customers', [CustomersController::class, 'index']);
            Route::get('customers/{customer}', [CustomersController::class, 'show']);
        });
        Route::middleware('permission:customers.manage')->group(function () {
            Route::post('customers', [CustomersController::class, 'store']);
            Route::put('customers/{customer}', [CustomersController::class, 'update']);
            Route::delete('customers/{customer}', [CustomersController::class, 'destroy']);
        });

        Route::middleware('permission:inventory.view')->group(function () {
            Route::get('inventory', [InventoryController::class, 'index']);
            Route::get('inventory/{inventory}', [InventoryController::class, 'show']);
            Route::get('stock-movements', [StockMovementsController::class, 'index']);
        });

        Route::middleware('permission:stock_adjustments.manage')->group(function () {
            Route::get('stock-adjustments', [StockAdjustmentsController::class, 'index']);
            Route::post('stock-adjustments', [StockAdjustmentsController::class, 'store']);
            Route::get('stock-adjustments/{stockAdjustment}', [StockAdjustmentsController::class, 'show']);
        });
        Route::middleware('permission:stock_adjustments.approve')->group(function () {
            Route::post('stock-adjustments/{stockAdjustment}/approve', [StockAdjustmentsController::class, 'approve']);
        });

        Route::middleware('permission:stock_transfers.manage')->group(function () {
            Route::get('stock-transfers', [StockTransfersController::class, 'index']);
            Route::post('stock-transfers', [StockTransfersController::class, 'store']);
            Route::get('stock-transfers/{stockTransfer}', [StockTransfersController::class, 'show']);
        });
        Route::middleware('permission:stock_transfers.approve')->group(function () {
            Route::post('stock-transfers/{stockTransfer}/approve', [StockTransfersController::class, 'approve']);
        });

        Route::middleware('permission:purchases.manage')->group(function () {
            Route::get('purchases', [PurchasesController::class, 'index']);
            Route::post('purchases', [PurchasesController::class, 'store']);
            Route::get('purchases/{purchase}', [PurchasesController::class, 'show']);
            Route::delete('purchases/{purchase}', [PurchasesController::class, 'destroy']);
        });
        Route::middleware('permission:purchases.approve')->group(function () {
            Route::post('purchases/{purchase}/approve', [PurchasesController::class, 'approve']);
            Route::post('purchases/{purchase}/receive', [PurchasesController::class, 'receive']);
        });

        Route::middleware('permission:sales.manage')->group(function () {
            Route::get('sales', [SalesController::class, 'index']);
            Route::post('sales', [SalesController::class, 'store']);
            Route::get('sales/{sale}', [SalesController::class, 'show']);
            Route::post('sales/{sale}/complete', [SalesController::class, 'complete']);
            Route::delete('sales/{sale}', [SalesController::class, 'destroy']);
        });

        Route::middleware('permission:reports.view')->group(function () {
            Route::get('reports/stock-summary', [ReportsController::class, 'stockSummary']);
            Route::get('reports/sales-summary', [ReportsController::class, 'salesSummary']);
            Route::get('reports/low-stock', [ReportsController::class, 'lowStock']);
            Route::get('reports/export-stock', [ReportsController::class, 'exportStock']);
        });

        Route::middleware('permission:notifications.view')->group(function () {
            Route::get('notifications', [NotificationsController::class, 'index']);
            Route::post('notifications/{notificationId}/read', [NotificationsController::class, 'markRead']);
        });

        Route::middleware('permission:audit.view')->group(function () {
            Route::get('audit-logs', [AuditLogsController::class, 'index']);
        });
    });
});
