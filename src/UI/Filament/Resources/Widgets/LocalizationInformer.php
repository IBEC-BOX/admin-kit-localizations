<?php

namespace AdminKit\Localizations\UI\Filament\Resources\Widgets;

use AdminKit\Core\Facades\AdminKit;
use Filament\Widgets\TableWidget;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LocalizationInformer extends TableWidget
{
    protected int|string|array $columnSpan = 2;

    protected $listeners = ['refreshLocalizationInformer' => '$refresh'];

    public function render(): View
    {
        $exists = $sizes = $counts = [];
        foreach (AdminKit::locales() as $locale) {
            $path = lang_path("$locale.json");
            $exists[$locale] = File::exists($path);

            if ($exists[$locale]) {
                $sizes[$locale] = number_format(File::size($path) / 1024, 2) . ' Kb';
            }

            if ($exists[$locale]) {
                $count = count(json_decode(File::get($path), true));
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
        return Storage::disk('languages')->download("$locale.json");
    }
}
