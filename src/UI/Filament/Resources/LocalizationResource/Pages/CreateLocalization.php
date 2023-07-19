<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

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

    public function beforeCreate()
    {
        foreach (config('admin-kit.locales') as $value) {
            $file = lang_path($value.'.json');
            if (! file_exists($file)) {
                file_put_contents($file, json_encode([$this->data['key'] => $this->data['content'][$value]], JSON_UNESCAPED_UNICODE));
            } else {
                $fileOpened = file_get_contents($file);
                $fullData = json_decode($fileOpened);
                $key = $this->data['key'];
                $fullData->$key = $this->data['content'][$value];
                file_put_contents($file, json_encode($fullData, JSON_UNESCAPED_UNICODE));
            }
        }
    }
}
