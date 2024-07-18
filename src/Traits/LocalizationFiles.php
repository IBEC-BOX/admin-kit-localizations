<?php

namespace AdminKit\Localizations\Traits;

use AdminKit\Core\Facades\AdminKit;
use AdminKit\Localizations\Facades\Localizations;
use Illuminate\Support\Facades\File;

trait LocalizationFiles
{
    protected function addLocalization(string $key, array $content): void
    {
        foreach (AdminKit::locales() as $locale) {
            $path = Localizations::getPath($locale);

            $jsonContent = file_exists($path)
                ? File::json($path)
                : [];

            $jsonContent[$key] = $content[$locale];

            File::put($path, json_encode($jsonContent, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }
}
