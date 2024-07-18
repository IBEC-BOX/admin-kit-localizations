<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use AdminKit\Core\Traits\Filament\RedirectToListPageAfterSave;
use AdminKit\Localizations\Traits\LocalizationFiles;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLocalization extends CreateRecord
{
    use LocalizationFiles;
    use RedirectToListPageAfterSave;

    protected static string $resource = LocalizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    public function beforeCreate(): void
    {
        $this->addLocalization(
            $this->data['key'],
            $this->data['content']
        );
    }
}
