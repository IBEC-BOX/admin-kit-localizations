<?php

namespace AdminKit\Localizations\UI\Filament\Resources\Widgets;

use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\Storage;

class LocalizationFiles extends TableWidget
{
    protected static string $view = 'admin-kit-localizations::widgets.localization-files';

    protected int | string | array $columnSpan = 2;

    public function downloadTranslationFile($locale)
    {
        return Storage::disk('languages')->download("$locale.json");
    }
}
