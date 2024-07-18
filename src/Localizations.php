<?php

namespace AdminKit\Localizations;

class Localizations
{
    public function getPath(string $locale): string
    {
        $path = config('admin-kit-localizations.path');
        if (! str_contains($path, '{locale}')) {
            throw new \Exception('The config "admin-kit-localizations.path" must contain "{locale}"');
        }

        return str_replace('{locale}', $locale, $path);
    }
}
