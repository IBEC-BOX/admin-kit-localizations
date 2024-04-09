<?php

declare(strict_types=1);

namespace AdminKit\Localizations\UI\API\Controllers;

use AdminKit\Localizations\Models\Localization;
use AdminKit\Localizations\UI\API\Data\LocalizationData;

class LocalizationController extends Controller
{
    public function index()
    {
        return LocalizationData::collection(Localization::all());
    }

    public function show(int $id)
    {
        return Localization::findOrFail($id);
    }
}
