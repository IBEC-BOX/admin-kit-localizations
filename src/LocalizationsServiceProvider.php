<?php

namespace AdminKit\Localizations;

use AdminKit\Localizations\Commands\LocalizationsCommand;
use AdminKit\Localizations\Providers\RouteServiceProvider;
use AdminKit\Localizations\UI\API\Repositories\CachedLocalizationRepository;
use AdminKit\Localizations\UI\API\Repositories\LocalizationRepository;
use AdminKit\Localizations\UI\API\Repositories\LocalizationRepositoryInterface;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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

    public function bootingPackage()
    {
        $this->publishFiles();

        $repository = match ((bool) config('admin-kit.cache.enabled')) {
            true => CachedLocalizationRepository::class,
            false => LocalizationRepository::class,
        };
        $this->app->bind(LocalizationRepositoryInterface::class, $repository);
    }

    protected function registerConfigs(): self
    {
        $this->mergeConfigFrom(__DIR__.'/../config/filesystems_disks.php', 'filesystems.disks');

        return $this;
    }

    protected function publishFiles(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/.gitignore.stub' => storage_path('localizations/.gitignore'),
            ], 'admin-kit-localizations-stubs');
        }

        return $this;
    }
}
