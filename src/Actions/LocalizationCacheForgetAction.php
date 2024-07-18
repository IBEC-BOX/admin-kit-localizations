<?php

declare(strict_types=1);

namespace AdminKit\Localizations\Actions;

use AdminKit\Core\Facades\AdminKit;
use Illuminate\Support\Facades\Cache;

class LocalizationCacheForgetAction
{
    public function run(): void
    {
        Cache::forget('ak_localizations');

        foreach (AdminKit::locales() as $locale) {
            Cache::forget("ak_localizations_$locale");
        }
    }
}
