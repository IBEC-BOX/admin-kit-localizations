<?php

namespace AdminKit\Localizations\UI\Filament\Resources\LocalizationResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use AdminKit\Core\Facades\AdminKit;
use Illuminate\Support\Facades\File;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use AdminKit\Localizations\Models\Localization;
use AdminKit\Localizations\UI\Filament\Resources\LocalizationResource;
use AdminKit\Localizations\UI\Filament\Resources\Widgets\LocalizationInformer;

class ListLocalization extends ListRecords
{
    protected static string $resource = LocalizationResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            LocalizationInformer::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('publish')
                ->label(__('admin-kit-localizations::localizations.resource.publish'))
                ->action('publish')
                ->tooltip(__('admin-kit-localizations::localizations.resource.publish_action_tooltip')),
            Actions\CreateAction::make(),
        ];
    }

    public function publish(): void
    {
        $localizations = Localization::query()
            ->select('key', 'content')
            ->orderBy('id')
            ->get();

        foreach (AdminKit::locales() as $locale) {
            $path = lang_path("$locale.json");

            $jsonContent = $localizations
                ->mapWithKeys(fn ($value, $key) => [
                    $value->key => $value->getTranslation('content', $locale),
                ])
                ->toArray();

            File::put($path, json_encode($jsonContent, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }

        Notification::make()
            ->title(__('admin-kit-localizations::localizations.resource.localization_files_saved'))
            ->success()
            ->send();

        $this->dispatch('refreshLocalizationInformer'); // livewire event
    }
}
