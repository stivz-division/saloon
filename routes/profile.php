<?php

use App\Livewire\Page\ProfilePage;
use Illuminate\Support\Facades\Route;

Route::get('/', ProfilePage::class)
    ->name('profile');
