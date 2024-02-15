<?php

namespace AdminKit\Localizations\Traits;

use AdminKit\Core\Facades\AdminKit;
use Illuminate\Support\Facades\File;

trait LocalizationFiles
{
    protected function addLocalization(string $key, array $values): void
    {
        foreach (AdminKit::locales() as $locale) {
            $path = lang_path("$locale.json");

            $jsonContent = file_exists($path)
                ? File::json($path)
                : [];

            $jsonContent[$key] = $values[$locale];

            File::put($path, json_encode($jsonContent, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }
}
