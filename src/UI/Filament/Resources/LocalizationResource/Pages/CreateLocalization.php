<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use AdminKit\Core\Facades\AdminKit;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLocalization extends CreateRecord
{
    protected static string $resource = LocalizationResource::class;

    protected function getActions(): array
    {
        return [
            //
        ];
    }

    protected function getRedirectUrl(): string
    {
        return LocalizationResource::getUrl();
    }

    public function beforeCreate(): void
    {
        $this->updateLocalizationFile();
    }

    protected function updateLocalizationFile(): void
    {
        foreach (AdminKit::locales() as $locale) {
            $key = $this->data['key'];
            $value = $this->data['content'][$locale];
            $path = lang_path($locale.'.json');

            if (! file_exists($path)) {
                file_put_contents($path, json_encode([$key => $value], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            } else {
                $jsonContent = json_decode(file_get_contents($path), true);
                $jsonContent[$key] = $value;
                file_put_contents($path, json_encode($jsonContent, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }
        }
    }
}
