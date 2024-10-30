<?php

namespace AdminKit\Localizations\UI\API\Data;

use Spatie\LaravelData\Data;

class LocalizationData extends Data
{
    public function __construct(
        public string $key,
        public ?string $content,
    ) {}
}
