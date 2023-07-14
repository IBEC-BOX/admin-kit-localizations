<?php

use AdminKit\Localizations\UI\API\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;

Route::get('/localizations', [LocalizationController::class, 'index']);
Route::get('/localizations/{id}', [LocalizationController::class, 'show']);
