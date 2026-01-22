<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, AppointmentController};

Route::livewire('/', 'home-content')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire('dashboard', 'dashboard')->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        // Employees
        Route::prefix('employees')->name('employees.')->group(function () {
            Route::livewire('/', 'employees.index')->name('index');
            Route::livewire('/create', 'employees.create')->name('create');
            Route::livewire('/{employee}/edit', 'employees.edit')->name('edit');
        });

        // Services
        Route::prefix('services')->name('services.')->group(function () {
            Route::livewire('/', 'services.index')->name('index');
            Route::livewire('/create', 'services.create')->name('create');
            Route::livewire('/{service}/edit', 'services.edit')->name('edit');
        });

        // Company Settings
        Route::prefix('company-settings')->name('company-settings.')->group(function () {
            Route::livewire('/', 'company-settings.index')->name('index');
        });
    });

    Route::middleware(['role:employee'])->group(function () {
        Route::prefix('employees')->name('employees.')->group(function () {
            Route::livewire('/gallery', 'employees.gallery')->name('gallery');
        });
    });

    // Appointments
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::livewire('/', 'appointments.index')->name('index');
    });
});

Route::prefix('citas')->name('appointments.')->group(function () {
    Route::livewire('/agendar', 'appointments.create')->name('create');
});

require __DIR__.'/settings.php';
