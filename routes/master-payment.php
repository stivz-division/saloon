<?php

use App\Livewire\Page\MasterPayment\ClientAdvertisementPage;
use App\Livewire\Page\MasterPayment\SubscriptionPage;
use Illuminate\Support\Facades\Route;

Route::get('client-advertisement/{advertisement}',
    ClientAdvertisementPage::class)
    ->name('client-advertisement');

Route::get('subscription',
    SubscriptionPage::class)
    ->name('subscription');
