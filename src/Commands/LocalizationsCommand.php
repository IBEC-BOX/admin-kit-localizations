<?php

namespace AdminKit\Localizations\Commands;

use Illuminate\Console\Command;

class LocalizationsCommand extends Command
{
    public $signature = 'admin-kit-localizations';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
