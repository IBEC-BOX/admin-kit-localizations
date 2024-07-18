<?php

namespace AdminKit\Localizations\Commands;

use AdminKit\Localizations\LocalizationsServiceProvider;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    public $signature = 'admin-kit:install-localizations';

    public $description = 'Install AdminKit Articles package';

    public function handle(): int
    {
        if ($this->confirm('Publishing stubs and migrations?', true)) {
            $this->call('vendor:publish', [
                '--provider' => LocalizationsServiceProvider::class,
                '--tag' => 'admin-kit-localizations-stubs',
            ]);
            $this->call('vendor:publish', [
                '--provider' => LocalizationsServiceProvider::class,
                '--tag' => 'admin-kit-localizations-migrations',
            ]);
        }

        if ($this->confirm('Migrate the database tables?', true)) {
            $this->call('migrate');
        }

        if ($this->confirm('(Optional) Publishing config file?')) {
            $this->call('vendor:publish', [
                '--provider' => LocalizationsServiceProvider::class,
                '--tag' => 'admin-kit-localizations-config',
            ]);
        }

        return self::SUCCESS;
    }
}
