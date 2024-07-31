<?php

namespace AdminKit\Localizations;

use AdminKit\Localizations\Commands\InstallCommand;
use AdminKit\Localizations\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Gate;
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
            ->hasCommand(InstallCommand::class);
    }

    public function registeringPackage()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->registerConfigs();
    }

    public function bootingPackage()
    {
        $this->publishFiles();

        $this->bindingPolicies();

        $this->bindingRepositories();
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

    protected function bindingPolicies(): void
    {
        Gate::policy(\AdminKit\Localizations\Models\Localization::class, \AdminKit\Localizations\Policies\LocalizationPolicy::class);
    }

    protected function bindingRepositories(): void
    {
        $repository = \AdminKit\Localizations\UI\API\Repositories\LocalizationRepository::class;
        if (config('admin-kit.cache.enabled')) {
            $repository = \AdminKit\Localizations\UI\API\Repositories\CachedLocalizationRepository::class;
        }

        $this->app->bind(\AdminKit\Localizations\UI\API\Repositories\LocalizationRepositoryInterface::class, $repository);
    }
}
