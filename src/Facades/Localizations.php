<?php

namespace AdminKit\Localizations\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getPath(string $locale)
 *
 * @see \AdminKit\Localizations\Localizations
 */
class Localizations extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AdminKit\Localizations\Localizations::class;
    }
}
