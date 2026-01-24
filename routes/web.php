<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'home-content')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::livewire('dashboard', 'dashboard')->name('dashboard');
});


require __DIR__.'/settings.php';
