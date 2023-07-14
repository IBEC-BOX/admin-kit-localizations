<?php

namespace VendorName\Skeleton\UI\Filament\Resources\SingleNameResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use VendorName\Skeleton\UI\Filament\Resources\SingleNameResource;

class EditSingleName extends EditRecord
{
    protected static string $resource = SingleNameResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
