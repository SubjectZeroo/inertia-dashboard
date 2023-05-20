<?php

use App\Http\Controllers\MachineController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RemoveRoleFromUserController;
use App\Http\Controllers\RevokePermissionFromUserController;
use App\Http\Controllers\RevokePermissionsFromRoleController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::redirect('/', '/login');

Route::middleware([
    'auth:web',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    // Route::get('users', [UsersController::class, 'index'])
    //     ->name('users');

    // Route::get('users/create', [UsersController::class, 'create'])
    //     ->name('users.create');

    // Route::post('users', [UsersController::class, 'store'])
    //     ->name('users.store');

    // Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    //     ->name('users.edit');

    // Route::put('users/{user}', [UsersController::class, 'update'])
    //     ->name('users.update');

    // Route::delete('users/{user}', [UsersController::class, 'destroy'])
    //     ->name('users.destroy');



    // Route::get('roles', [RolesController::class, 'index'])
    //     ->name('roles');

    // Route::get('roles/create', [RolesController::class, 'create'])
    //     ->name('roles.create');

    // Route::post('roles', [RolesController::class, 'store'])
    //     ->name('roles.store');

    // Route::get('roles/{role}/edit', [RolesController::class, 'edit'])
    //     ->name('roles.edit');

    // Route::put('roles/{role}', [RolesController::class, 'update'])
    //     ->name('roles.update');

    // Route::delete('roles/{role}', [RolesController::class, 'destroy'])
    //     ->name('roles.destroy');

    // Route::get('permissions', [PermissionsController::class, 'index'])
    //     ->name('permissions');

    // Route::get('permissions/create', [PermissionsController::class, 'create'])
    //     ->name('permissions.create');

    // Route::post('permissions', [PermissionsController::class, 'store'])
    //     ->name('permissions.store');

    // Route::get('permissions/{permission}/edit', [PermissionsController::class, 'edit'])
    //     ->name('permissions.edit');

    // Route::put('permissions/{permission}', [PermissionsController::class, 'update'])
    //     ->name('permissions.update');

    // Route::delete('permissions/{permission}', [PermissionsController::class, 'destroy'])
    //     ->name('permissions.destroy');


    Route::middleware(['auth', 'role:Super Admin'])->group(function () {
        Route::resource('/users', UsersController::class);
        Route::resource('/roles', RolesController::class);
        Route::resource('/permissions', PermissionsController::class);

        Route::delete('roles/{role}/permissions/{permission}', RevokePermissionsFromRoleController::class)->name('roles.permissions.destroy');

        Route::delete('user/{user}/permissions/{permission}', RevokePermissionFromUserController::class)->name('users.permissions.destroy');

        Route::delete('users/{user}/roles/{roles}', RemoveRoleFromUserController::class)->name('users.roles.destroy');
    });

    Route::resource('/machines', MachineController::class);
});
