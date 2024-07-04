<?php

namespace AdminKit\Localizations\UI\API\Data;

use AdminKit\Localizations\Models\Localization;
use Spatie\LaravelData\Concerns\WithDeprecatedCollectionMethod;
use Spatie\LaravelData\Data;

class LocalizationData extends Data
{
    use WithDeprecatedCollectionMethod;

    public function __construct(
        public string $key,
        public array|string $content,
    ) {
    }

    public static function fromModel(Localization $localization): LocalizationData
    {
        $content = $localization->getTranslations('content');

        if ($locale = request('locale')) {
            $content = $content[$locale] ?? $content;
        }

        return new self(
            key: $localization->key,
            content: $content,
        );
    }
}
