<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('employees')->name('employees.')->middleware(['auth', 'verified'])->group(function () {
    Route::livewire('/', 'employees.index')->name('index');
    Route::livewire('/create', 'employees.create')->name('create');
    Route::livewire('/{employee}/edit', 'employees.edit')->name('edit');
});

Route::prefix('services')->name('services.')->middleware(['auth', 'verified'])->group(function () {
    Route::livewire('/', 'services.index')->name('index');
    Route::livewire('/create', 'services.create')->name('create');
    Route::livewire('/{service}/edit', 'services.edit')->name('edit');
});

Route::prefix('appointments')->name('appointments.')->middleware(['auth', 'verified'])->group(function () {
    Route::livewire('/', 'appointments.index')->name('index');
});

require __DIR__.'/settings.php';
