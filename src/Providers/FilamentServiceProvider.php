<?php

declare(strict_types=1);

namespace AdminKit\Localizations\Providers;

use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;
use Filament\PluginServiceProvider;

class FilamentServiceProvider extends PluginServiceProvider
{
    public static string $name = 'localizations';

    protected array $resources = [
        LocalizationResource::class,
    ];
}
