<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use AdminKit\Core\Facades\AdminKit;
use AdminKit\Localizations\Models\Localization;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;
use AdminKit\Localizations\UI\Filament\Resources\Widgets\LocalizationInformer;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\File;

class ListLocalization extends ListRecords
{
    protected static string $resource = LocalizationResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            LocalizationInformer::class,
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\Action::make('publish')
                ->label(__('admin-kit-localizations::localizations.resource.publish'))
                ->action('publish')
                ->tooltip(__('admin-kit-localizations::localizations.resource.publish_action_tooltip')),
            Actions\CreateAction::make(),
        ];
    }

    public function publish()
    {
        $localizations = Localization::query()
            ->select('key', 'content')
            ->orderBy('id')
            ->get();
        foreach(AdminKit::locales() as $locale) {
            $path = lang_path("$locale.json");
            $jsonContent = $localizations
                ->mapWithKeys(fn ($value, $key) => [$value->key => $value->getTranslation('content', $locale)])
                ->toArray();

            File::put($path, json_encode($jsonContent, JSON_UNESCAPED_UNICODE));
        }

        Notification::make()
            ->title(__('admin-kit-localizations::localizations.resource.localization_files_saved'))
            ->success()
            ->send();
    }
}
