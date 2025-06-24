<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarrantyController;
use App\Http\Controllers\SalesUnitController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return "Xin chao the gioi";
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('/admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    // 🔹 Agents
    Route::prefix('/agents')->name('agents.')->middleware('permission:agent.view')->group(function () {
        Route::get('/', [AgentController::class, 'index'])->name('index');
        Route::get('/show/{id}', [AgentController::class, 'show'])->name('show');
        Route::get('/search', [AgentController::class, 'search'])->name('search');
    });
    Route::prefix('/agents')->name('agents.')->middleware('permission:agent.create')->group(function () {
        Route::get('/create', [AgentController::class, 'create'])->name('create');
        Route::post('/store', [AgentController::class, 'store'])->name('store');
    });
    Route::prefix('/agents')->name('agents.')->middleware('permission:agent.edit')->group(function () {
        Route::get('/edit/{id}', [AgentController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [AgentController::class, 'update'])->name('update');
    });

    // 🔹 Projects
    Route::prefix('/projects')->name('projects.')->middleware('permission:project.view')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/show/{id}', [ProjectController::class, 'show'])->name('show');
    });
    Route::prefix('/projects')->name('projects.')->middleware('permission:project.create')->group(function () {
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/store', [ProjectController::class, 'store'])->name('store');
    });
    Route::prefix('/projects')->name('projects.')->middleware('permission:project.edit')->group(function () {
        Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProjectController::class, 'update'])->name('update');
    });

    // 🔹 Categories
    Route::prefix('/categories')->name('categories.')->middleware('permission:category.view')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');
    });
    Route::prefix('/categories')->name('categories.')->middleware('permission:category.create')->group(function () {
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
    });
    Route::prefix('/categories')->name('categories.')->middleware('permission:category.edit')->group(function () {
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
    });

    // 🔹 Warehouses
    Route::prefix('/warehouses')->name('warehouses.')->middleware('permission:warehouse.view')->group(function () {
        Route::get('/', [WarehouseController::class, 'index'])->name('index');
        Route::get('/show/{id}', [WarehouseController::class, 'show'])->name('show');
    });
    Route::prefix('/warehouses')->name('warehouses.')->middleware('permission:warehouse.create')->group(function () {
        Route::get('/create', [WarehouseController::class, 'create'])->name('create');
        Route::post('/store', [WarehouseController::class, 'store'])->name('store');
    });
    Route::prefix('/warehouses')->name('warehouses.')->middleware('permission:warehouse.edit')->group(function () {
        Route::get('/edit/{id}', [WarehouseController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [WarehouseController::class, 'update'])->name('update');
    });

    // 🔹 Sales Units
    Route::prefix('/sales-unit')->name('sales_units.')->middleware('permission:sales_unit.view')->group(function () {
        Route::get('/', [SalesUnitController::class, 'index'])->name('index');
        Route::get('/show/{id}', [SalesUnitController::class, 'show'])->name('show');
    });
    Route::prefix('/sales-unit')->name('sales_units.')->middleware('permission:sales_unit.create')->group(function () {
        Route::get('/create', [SalesUnitController::class, 'create'])->name('create');
        Route::post('/store', [SalesUnitController::class, 'store'])->name('store');
    });
    Route::prefix('/sales-unit')->name('sales_units.')->middleware('permission:sales_unit.edit')->group(function () {
        Route::get('/edit/{id}', [SalesUnitController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SalesUnitController::class, 'update'])->name('update');
    });

    // 🔹 Devices
    Route::prefix('/devices')->name('devices.')->middleware('permission:device.view')->group(function () {
        Route::get('/', [DeviceController::class, 'index'])->name('index');
        Route::get('/show/{id}', [DeviceController::class, 'show'])->name('show');
    });
    Route::prefix('/devices')->name('devices.')->middleware('permission:device.create')->group(function () {
        Route::get('/create', [DeviceController::class, 'create'])->name('create');
        Route::post('/store', [DeviceController::class, 'store'])->name('store');
    });
    Route::prefix('/devices')->name('devices.')->middleware('permission:device.edit')->group(function () {
        Route::get('/edit/{id}', [DeviceController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [DeviceController::class, 'update'])->name('update');
    });
    Route::delete('/devices/{id}', [DeviceController::class, 'destroy'])->name('devices.destroy')->middleware('permission:device.destroy');



    // 🔹 Warranties
    Route::prefix('/warranties')->name('warranties.')->middleware('permission:warranty.view')->group(function () {
        Route::get('/', [WarrantyController::class, 'index'])->name('index');
        Route::get('/show/{id}', [WarrantyController::class, 'show'])->name('show');
    });
    Route::prefix('/warranties')->name('warranties.')->middleware('permission:warranty.create')->group(function () {
        Route::get('/create', [WarrantyController::class, 'create'])->name('create');
        Route::post('/store', [WarrantyController::class, 'store'])->name('store');
    });
    Route::prefix('/warranties')->name('warranties.')->middleware('permission:warranty.edit')->group(function () {
        Route::get('/edit/{id}', [WarrantyController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [WarrantyController::class, 'update'])->name('update');
    });

    // 🔹 Users
    Route::prefix('/users')->name('users.')->middleware('permission:user.view')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
    });
    Route::prefix('/users')->name('users.')->middleware('permission:user.create')->group(function () {
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');

    });
    Route::prefix('/users')->name('users.')->middleware('permission:user.edit')->group(function () {
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
    });

    // 🔹 Roles
    Route::prefix('/roles')->name('roles.')->middleware('permission:role.view')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/show/{id}', [RoleController::class, 'show'])->name('show');
    });
    Route::prefix('/roles')->name('roles.')->middleware('permission:role.create')->group(function () {
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
    });
    Route::prefix('/roles')->name('roles.')->middleware('permission:role.edit')->group(function () {
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('update');
    });

    // 🔹 Công nợ
    Route::prefix('/debts')->name('debts.')->group(function () {
        Route::get('/', [DebtController::class, 'index'])
            ->middleware('permission:debt.view')
            ->name('index');

        Route::get('/show/{id}', [DebtController::class, 'show'])
            ->middleware('permission:debt.view')
            ->name('show');

        Route::get('/create', [DebtController::class, 'create'])
            ->middleware('permission:debt.create')
            ->name('create');

        Route::post('/store', [DebtController::class, 'store'])
            ->middleware('permission:debt.create')
            ->name('store');

        Route::get('/{debt}/edit', [DebtController::class, 'edit'])
            ->middleware('permission:debt.edit')
            ->name('edit');

        Route::put('/{debt}', [DebtController::class, 'update'])
            ->middleware('permission:debt.edit')
            ->name('update');

        Route::put('/{debt}/approve', [DebtController::class, 'approve'])
            ->middleware('permission:debt.approve')
            ->name('approve');

        Route::put('/{debt}/cancel', [DebtController::class, 'cancel'])
            ->middleware('permission:debt.cancel')
            ->name('cancel');
    });
});