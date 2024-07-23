<?php

use App\Livewire\Page\SubscriptionPage;
use Illuminate\Support\Facades\Route;

Route::get('/', SubscriptionPage::class)
    ->name('list');