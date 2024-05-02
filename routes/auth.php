<?php

use App\Livewire\Page\Auth\LoginPage;
use App\Livewire\Page\Auth\RegisterPage;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('login', LoginPage::class)
        ->name('login');

    Route::get('register', RegisterPage::class)
        ->name('register');
});