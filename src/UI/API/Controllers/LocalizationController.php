<?php

declare(strict_types=1);

namespace AdminKit\Localizations\UI\API\Controllers;

use AdminKit\Localizations\Models\Localization;

class LocalizationController extends Controller
{
    public function index()
    {
        return Localization::all();
    }

    public function show(int $id)
    {
        return Localization::findOrFail($id);
    }
}
