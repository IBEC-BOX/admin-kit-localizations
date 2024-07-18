<?php

namespace AdminKit\Localizations\UI\Filament\Resources\Widgets;

use AdminKit\Core\Facades\AdminKit;
use AdminKit\Localizations\Facades\Localizations;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class LocalizationInformer extends Widget
{
    protected int|string|array $columnSpan = 2;

    protected $listeners = ['refreshLocalizationInformer' => '$refresh'];

    public function render(): View
    {
        $exists = $sizes = $counts = [];
        foreach (AdminKit::locales() as $locale) {
            $file = Storage::disk(config('admin-kit-localizations.disk'));
            $path = Localizations::getPath($locale);
            $exists[$locale] = $file->exists($path);

            if ($exists[$locale]) {
                $sizes[$locale] = number_format($file->size($path) / 1024, 2).' Kb';
            }

            if ($exists[$locale]) {
                $count = count(json_decode($file->get($path), true));
                $counts[$locale] = trans_choice(
                    'admin-kit-localizations::localizations.count_keys',
                    $count,
                    ['count' => $count]
                );
            }
        }

        return view('admin-kit-localizations::widgets.localization-files', [
            'exists' => $exists,
            'sizes' => $sizes,
            'counts' => $counts,
        ]);
    }

    public function downloadTranslationFile($locale)
    {
        $file = Storage::disk(config('admin-kit-localizations.disk'));

        $path = Localizations::getPath($locale);

        if (! $file->exists($path)) {
            Notification::make()
                ->title(__('File not found'))
                ->danger()
                ->send();

            return null;
        }

        return $file->download($path);
    }
}
