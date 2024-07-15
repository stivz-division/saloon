<?php

use App\Http\Middleware\IsMasterMiddleware;
use App\Livewire\Page\Advertisement\Master\MasterAdvertisementPage;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::middleware([IsMasterMiddleware::class])
        ->get('/create', MasterAdvertisementPage::class)
        ->name('create');
});

