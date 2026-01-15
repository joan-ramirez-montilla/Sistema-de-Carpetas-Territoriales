<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('employees')->name('employees.')->group(function () {
    Route::livewire('/', 'employees.index')->name('index');
    Route::livewire('/create', 'employees.create')->name('create');
    Route::livewire('/{employee}/edit', 'employees.edit')->name('edit');
});

require __DIR__.'/settings.php';
