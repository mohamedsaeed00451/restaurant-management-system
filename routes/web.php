<?php

use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ItemTypesController;
use App\Http\Controllers\UsersController;
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

//*************************** Home page ********************//
Route::get('/', function () {
    return view('pages.login');
})->middleware('guest');

//*************************** Login ********************//
Route::post('/login', [UsersController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {

    //*************************** Dashboard ********************//
    Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('dashboard');

    //*************************** User Invoices ********************//
    Route::get('/user-invoices/{id}', [UsersController::class, 'getUserInvoices'])->name('user.invoices');

    //*************************** User Expenses ********************//
    Route::get('/user-expenses/{id}', [UsersController::class, 'getUserExpenses'])->name('user.expenses');

    //*************************** Logout ********************//
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

    //*************************** Users ********************//
    Route::resource('/users', UsersController::class);

    //*************************** Items ********************//
    Route::resource('/items', ItemsController::class);

    //*************************** Items Types ********************//
    Route::resource('/items-types', ItemTypesController::class);

    //*************************** Employees ********************//
    Route::resource('/employees', EmployeesController::class);

    //*************************** Expenses ********************//
    Route::resource('/expenses', ExpensesController::class);

    //*************************** Invoices ********************//
    Route::resource('/invoices', InvoicesController::class);

    //*************************** Add Invoice ********************//
    Route::get('/add-invoice', [InvoicesController::class, 'store'])->name('add.invoice');

    Route::get('/get-item-types', [InvoicesController::class, 'getItemTypes']);

});
