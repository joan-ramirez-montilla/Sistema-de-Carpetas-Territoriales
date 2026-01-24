<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('people')->name('people.')->group(function () {
        Route::livewire('/', 'people.index')->name('index');
        Route::livewire('/create', 'people.create')->name('create');
        Route::livewire('/people/{person}/edit', 'people.edit')->name('edit');
    });
});


require __DIR__.'/settings.php';

Route::livewire('/', 'home-content')->name('home');
