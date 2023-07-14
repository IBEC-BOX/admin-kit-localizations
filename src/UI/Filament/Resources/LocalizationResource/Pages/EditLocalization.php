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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        foreach (config('admin-kit.locales') as $value){
            $data[$value] = $data['content'][$value];
        }
        return $data;
    }

    protected function beforeSave()
    {
        foreach (config('admin-kit.locales') as $value){
            $file = $_SERVER['DOCUMENT_ROOT'] . '/../resources/lang/' . $value . '.json';
            $fileOpened = file_get_contents($file);
            $key = $this->data['key'];
            if(isset(json_decode($fileOpened)->$key)){
                $fullData = json_decode($fileOpened);
                $fullData->$key = $this->data[$value];
                file_put_contents($file, json_encode($fullData));
            }
            else{
                $jsonContent = substr($fileOpened, 1);
                $newContent = substr_replace(json_encode([$this->data['key'] => $this->data[$value]]), '', -1);
                file_put_contents($file,  $newContent . ',' . $jsonContent);
            }
        }

    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $content = [];
        foreach (config('admin-kit.locales') as $value){
            $content[$value] = $this->data[$value];
        }
        $this->data['content'] = $content;

        return $this->data;
    }
}
