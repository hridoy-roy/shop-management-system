<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OpeningController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleReturnController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawController;
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

Route::get('/', function () {
    return view('welcome');
})->name('root');

Route::get('/dashboard', function () {
    $data = [
        'subTitle' => 'User Dashboard',
        'title' => 'Dashboard',
    ];
    return view('dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(callback: function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources([
        'categories' => ProductCategoryController::class,
        'products' => ProductController::class,
        'opening' => OpeningController::class,
        'purchases' => PurchaseController::class,
        'purchaseReturns' => PurchaseReturnController::class,
        'sales' => SaleController::class,
        'saleReturns' => SaleReturnController::class,
        'stock' => StockController::class,
        'customer' => CustomerController::class,
        'accounts' => AccountController::class,
        'withdraw' => WithdrawController::class,
        'settings' => SettingController::class,
        'users' => UserController::class,
    ]);
//    Stock
    Route::get('stock/present/list', [StockController::class, 'present'])->name('stock.present.list');
//    sales
    Route::get('sales/hold/list', [SaleController::class, 'holdList'])->name('sale.hold.list');
    Route::Post('sales/hold/confirm/{id}', [SaleController::class, 'holdConfirm'])->name('sale.hold.confirm');
    Route::get('sales/due/list', [SaleController::class, 'dueList'])->name('sale.due.list');
    Route::Post('sales/due/confirm/{id}', [SaleController::class, 'dueConfirm'])->name('sale.due.confirm');
    Route::get('sales/customer/report', [SaleController::class, 'saleCustomerReport'])->name('sale.customer.report');
    Route::Post('sales/customer/report', [SaleController::class, 'saleCustomerReportPost'])->name('sale.customer.report');
    Route::get('sales/reference/report', [SaleController::class, 'saleReferenceReport'])->name('sale.reference.report');
    Route::Post('sales/reference/report', [SaleController::class, 'saleReferenceReportPost'])->name('sale.reference.report');
    Route::get('sale/invoice/{id}', [SaleController::class, 'invoice'])->name('sale.invoice');
//    withdraw
    Route::get('withdraw/hold/list', [WithdrawController::class, 'holdList'])->name('withdraw.hold.list');
    Route::Post('withdraw/hold/confirm/{id}', [WithdrawController::class, 'holdConfirm'])->name('withdraw.hold.confirm');
//    account
    Route::get('balance-sheet', [AccountController::class, 'balanceSheet'])->name('balance.sheet');
    Route::get('profit-loss', [AccountController::class, 'profitLoss'])->name('profit.loss');
//    user
    Route::get('user/deleted', [UserController::class, 'userDeleted'])->name('users.deleted');
});

require __DIR__ . '/auth.php';
