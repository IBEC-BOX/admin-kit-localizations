<?php

use Illuminate\Support\Facades\Route;
use AdminKit\Localizations\UI\API\Controllers\LocalizationController;

Route::get('/localizations', [LocalizationController::class, 'index']);
Route::get('/localizations/{id}', [LocalizationController::class, 'show']);
