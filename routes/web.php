<?php

use App\Livewire\Page\TariffPage;
use App\Livewire\Page\WelcomePage;
use App\Livewire\Page\Workers\WorkersPage;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomePage::class)
    ->name('welcome');

Route::get('workers', WorkersPage::class)
    ->name('workers');

Route::get('tariff', TariffPage::class)
    ->name('tariff');

// Маршрут для раздачи видео
Route::get('/movies/{filename}', function ($filename) {
    $path = public_path("movies/$filename");

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');
