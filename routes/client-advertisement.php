<?php

use App\Http\Middleware\ClientAdvertisementCheckMiddleware;
use App\Http\Middleware\IsClientMiddleware;
use App\Livewire\Page\Advertisement\Client\ClientAdvertisementListPage;
use App\Livewire\Page\Advertisement\Client\ClientAdvertisementPage;
use App\Livewire\Page\Advertisement\Client\ClientAdvertisementShowPage;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::middleware([IsClientMiddleware::class])
        ->get('/create', ClientAdvertisementPage::class)
        ->name('create');

    Route::middleware([ClientAdvertisementCheckMiddleware::class])
        ->get('/{advertisement}',
            ClientAdvertisementShowPage::class)
        ->name('show');
});

Route::get('/', ClientAdvertisementListPage::class)
    ->name('list');

