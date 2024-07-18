<?php

namespace AdminKit\Localizations\Traits;

use AdminKit\Core\Facades\AdminKit;
use AdminKit\Localizations\Facades\Localizations;
use Illuminate\Support\Facades\Storage;

trait LocalizationFiles
{
    protected function addLocalization(string $key, array $content): void
    {
        foreach (AdminKit::locales() as $locale) {
            $file = Storage::disk(config('admin-kit-localizations.disk'));
            $path = Localizations::getPath($locale);

            $jsonContent = file_exists($path)
                ? $file->json($path)
                : [];

            $jsonContent[$key] = $content[$locale];

            $file->put($path, json_encode($jsonContent, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }
}
