<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;

class EditLocalization extends EditRecord
{
    protected static string $resource = LocalizationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
