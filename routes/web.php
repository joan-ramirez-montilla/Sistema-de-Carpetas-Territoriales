<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('territorial-folders')->name('territorial-folders.')->group(function () {
        Route::livewire('/', 'territorial-folders.index')->name('index');
    });

    Route::prefix('people')->name('people.')->group(function () {
        Route::livewire('/', 'people.index')->name('index');
        Route::livewire('/create', 'people.create')->name('create');
        Route::livewire('/people/{person}/edit', 'people.edit')->name('edit');
    });

    Route::prefix('regions')->name('regions.')->group(function () {
        Route::livewire('/', 'regions.index')->name('index');
        Route::livewire('/create', 'regions.create')->name('create');
        Route::livewire('/{region}/edit', 'regions.edit')->name('edit');
    });

    Route::prefix('provinces')->name('provinces.')->group(function () {
        Route::livewire('/', 'provinces.index')->name('index');
        Route::livewire('/create', 'provinces.create')->name('create');
        Route::livewire('/{province}/edit', 'provinces.edit')->name('edit');
    });

    Route::prefix('municipalities')->name('municipalities.')->group(function () {
        Route::livewire('/', 'municipalities.index')->name('index');
        Route::livewire('/create', 'municipalities.create')->name('create');
        Route::livewire('/{municipality}/edit', 'municipalities.edit')->name('edit');
    });

    Route::prefix('districts')->name('districts.')->group(function () {
        Route::livewire('/', 'districts.index')->name('index');
        Route::livewire('/create', 'districts.create')->name('create');
        Route::livewire('/{district}/edit', 'districts.edit')->name('edit');
    });

    Route::prefix('positions')->name('positions.')->group(function () {
        Route::livewire('/', 'positions.index')->name('index');
        Route::livewire('/create', 'positions.create')->name('create');
        Route::livewire('/{position}/edit', 'positions.edit')->name('edit');
    });

    Route::prefix('organizations')->name('organizations.')->group(function () {
        Route::livewire('/', 'organizations.index')->name('index');
        Route::livewire('/create', 'organizations.create')->name('create');
        Route::livewire('/{organization}/edit', 'organizations.edit')->name('edit');
    });
});


require __DIR__.'/settings.php';

Route::livewire('/', 'home-content')->name('home');
