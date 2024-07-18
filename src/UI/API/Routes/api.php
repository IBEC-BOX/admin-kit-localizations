<?php

use AdminKit\Localizations\UI\API\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;

Route::get('/localizations', [LocalizationController::class, 'getFullList']);
Route::get('/localizations/{locale}', [LocalizationController::class, 'getLocaledList'])
    ->where('locale', implode('|', AdminKit::locales()));
