<?php

namespace AdminKit\Localizations\UI\Filament\Resources\Widgets;

use AdminKit\Core\Facades\AdminKit;
use Filament\Widgets\TableWidget;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LocalizationInformer extends TableWidget
{
    protected static string $view = 'admin-kit-localizations::widgets.localization-files';

    protected int|string|array $columnSpan = 2;

    public array $exists = [];
    public array $size = [];
    public array $count = [];

    public function mount()
    {
        foreach (AdminKit::locales() as $locale) {
            $path = lang_path("$locale.json");
            $this->exists[$locale] = File::exists($path);
            if (File::exists($path)) {
                $this->size[$locale] = number_format(File::size($path) / 1024, 2) . ' Kb';
            }
            if (File::exists($path)) {
                $count = count(json_decode(File::get($path), true));
                $this->count[$locale] = trans_choice('admin-kit-localizations::localizations.count_keys', $count, ['count' => $count]);
            }
        }
    }

    public function downloadTranslationFile($locale)
    {
        return Storage::disk('languages')->download("$locale.json");
    }
}
