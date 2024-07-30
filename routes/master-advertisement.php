<?php

use App\Http\Middleware\IsMasterAuthorMiddleware;
use App\Http\Middleware\IsMasterMiddleware;
use App\Livewire\Page\Advertisement\Master\MasterAdvertisementEdit;
use App\Livewire\Page\Advertisement\Master\MasterAdvertisementListPage;
use App\Livewire\Page\Advertisement\Master\MasterAdvertisementPage;
use App\Livewire\Page\Advertisement\Master\MasterAdvertisementTop;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::middleware([IsMasterMiddleware::class])
        ->get('/create', MasterAdvertisementPage::class)
        ->name('create');

    Route::middleware([
        IsMasterMiddleware::class, IsMasterAuthorMiddleware::class,
    ])
        ->get('/{masterAdvertisement}/edit',
            MasterAdvertisementEdit::class)
        ->name('edit');

    Route::middleware([
        IsMasterMiddleware::class, IsMasterAuthorMiddleware::class,
    ])
        ->get('/{masterAdvertisement}/top',
            MasterAdvertisementTop::class)
        ->name('top');
});

Route::get('/list', MasterAdvertisementListPage::class)
    ->name('list');

