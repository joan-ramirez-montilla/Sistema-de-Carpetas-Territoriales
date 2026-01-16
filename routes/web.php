<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

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

    // Appointments
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::livewire('/', 'appointments.index')->name('index');
    });

    // Company Settings
    Route::prefix('company-settings')->name('company-settings.')->group(function () {
        Route::livewire('/', 'company-settings.index')->name('index');
    });

});

require __DIR__.'/settings.php';
