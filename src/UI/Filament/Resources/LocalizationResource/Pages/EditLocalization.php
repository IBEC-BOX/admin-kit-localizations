<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use AdminKit\Core\Facades\AdminKit;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLocalization extends EditRecord
{
    protected static string $resource = LocalizationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave()
    {
        $this->updateLocalizationFile();
    }

    protected function updateLocalizationFile(): void
    {
        foreach (AdminKit::locales() as $locale) {
            $key = $this->data['key'];
            $value = $this->data['content'][$locale];
            $path = lang_path("$locale.json");


            if (! file_exists($path)) {
                file_put_contents($path, json_encode([$key => $value], JSON_UNESCAPED_UNICODE));
            } else {
                $jsonContent = json_decode(file_get_contents($path), true);
                $jsonContent[$key] = $value;
                file_put_contents($path, json_encode($jsonContent, JSON_UNESCAPED_UNICODE));
            }
        }
    }
}
