<?php

namespace AdminKit\Localizations;

use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-plugin-admin-kit-localizations';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            LocalizationResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
    }

    public static function make(): static
    {
        return app(static::class);
    }
}
