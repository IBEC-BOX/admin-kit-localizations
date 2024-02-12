<?php

namespace AdminKit\Localizations;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AdminKit\Localizations\Commands\LocalizationsCommand;
use AdminKit\Localizations\Providers\RouteServiceProvider;

class LocalizationsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('admin-kit-localizations')
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasMigration('create_admin_kit_localizations_table')
            ->hasCommand(LocalizationsCommand::class);
    }

    public function registeringPackage()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->registerConfigs();
    }

    protected function registerConfigs(): self
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/filesystems_disks.php', 'filesystems.disks');

        return $this;
    }
}
