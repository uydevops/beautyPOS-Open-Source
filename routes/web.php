<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CampaignsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Middleware\AuthMiddleware;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
});

Route::group(['middleware' => AuthMiddleware::class], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::post('/settings-sms', [SettingsController::class, 'updateSMS'])->name('settings.sms');

    Route::get('/users', [DashboardController::class, 'users'])->name('users');
    Route::post('/users/update', [UsersController::class, 'updateUser'])->name('users.update');
    Route::get('/users/delete/{id}', [UsersController::class, 'deleteUser'])->name('users.delete');
    Route::post('/users/add', [UsersController::class, 'addUser'])->name('users.add');


    Route::get('/masalar', [DashboardController::class, 'tables'])->name('tables');
    Route::post('/masalar/add', [TablesController::class, 'add'])->name('tables.add');
    Route::get('/masalar/delete/{id}', [TablesController::class, 'delete'])->name('tables.delete');
    Route::post('/tables/{id}', [TablesController::class, 'update'])->name('tables.update');


    Route::get('/rezervasyonlar', [DashboardController::class, 'reservations'])->name('reservations');

    Route::get('/empty-table', [ReservationsController::class, 'emptyTable'])->name('empty-table');
    Route::get('/reserved-table', [ReservationsController::class, 'reservedTable'])->name('reserved-table');
    Route::post('/reservations/add', [ReservationsController::class, 'add'])->name('reserve-table');
    Route::post('/reservations/release', [ReservationsController::class, 'release'])->name('release-table');

    //feedback

    Route::get('/feedback', [DashboardController::class, 'feedback'])->name('feedbacks');


    Route::get('/personeller', [DashboardController::class, 'employees'])->name('employees');
    Route::post('/personeller/add', [EmployeesController::class, 'add'])->name('employees.add');
    Route::get('/personeller/delete/{id}', [EmployeesController::class, 'delete'])->name('employees.delete');
    Route::post('/personeller', [EmployeesController::class, 'update'])->name('employees.update');



    Route::get('/musteriler', [DashboardController::class, 'customers'])->name('customers');
    Route::post('/musteriler/add', [CustomersController::class, 'add'])->name('customers.add');
    Route::get('/musteriler/delete/{id}', [CustomersController::class, 'delete'])->name('customers.delete');
    Route::post('/musteriler', [CustomersController::class, 'update'])->name('customers.update');


    //kampanya
    Route::get('/kampanyalar', [DashboardController::class, 'campaigns'])->name('campaigns');
    Route::post('/kampanyalar/add', [CampaignsController::class, 'add'])->name('campaigns.add');
    Route::get('/kampanyalar/delete/{id}', [CampaignsController::class, 'delete'])->name('campaigns.delete');




    //services  
    Route::get('/services', [DashboardController::class, 'services'])->name('services');
    Route::post('/services/add', [ServicesController::class, 'add'])->name('services.add');
    Route::get('/services/delete/{id}', [ServicesController::class, 'delete'])->name('services.delete');
    Route::post('/services', [ServicesController::class, 'update'])->name('services.update');


    //categories

    Route::post('/categories/add', [CategoriesController::class, 'add'])->name('categories.add');
    Route::get('/categories/delete/{id}', [CategoriesController::class, 'delete'])->name('categories.delete');
    Route::post('/categories', [CategoriesController::class, 'update'])->name('categories.update');








    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
