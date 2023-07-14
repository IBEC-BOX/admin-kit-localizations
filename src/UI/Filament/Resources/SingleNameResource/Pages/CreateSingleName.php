<?php

namespace VendorName\Skeleton\UI\Filament\Resources\SingleNameResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use VendorName\Skeleton\UI\Filament\Resources\SingleNameResource;

class CreateSingleName extends CreateRecord
{
    protected static string $resource = SingleNameResource::class;

    protected function getActions(): array
    {
        return [
            //
        ];
    }

    protected function getRedirectUrl(): string
    {
        return SingleNameResource::getUrl();
    }
}
