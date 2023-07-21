<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

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

        foreach (config('admin-kit.locales') as $value) {
            $file = lang_path($value.'.json');
            $fileOpened = file_get_contents($file);
            $key = $this->data['key'];
            if (isset(json_decode($fileOpened)->$key)) {
                $fullData = json_decode($fileOpened);
                $fullData->$key = $this->data['content'][$value];
                file_put_contents($file, json_encode($fullData, JSON_UNESCAPED_UNICODE));
            } else {
                $jsonContent = substr($fileOpened, 1);
                $newContent = substr_replace(json_encode([$this->data['key'] => $this->data['content'][$value]], JSON_UNESCAPED_UNICODE), '', -1);
                file_put_contents($file, $newContent.','.$jsonContent);
            }
        }

    }
}
