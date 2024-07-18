<?php

namespace AdminKit\Localizations\UI\API\Data;

use Spatie\LaravelData\Data;

class LocalizationFullData extends Data
{
    public function __construct(
        public string $key,
        public array $content,
    ) {}
}
