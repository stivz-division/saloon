<?php

use App\Livewire\Page\TariffPage;
use App\Livewire\Page\WelcomePage;
use App\Livewire\Page\Workers\WorkersPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomePage::class)
    ->name('welcome');

Route::get('workers', WorkersPage::class)
    ->name('workers');

Route::get('tariff', TariffPage::class)
    ->name('tariff');

