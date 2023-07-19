<?php

namespace AdminKit\Localizations\Models;

use AdminKit\Core\Abstracts\Models\AbstractModel;
use AdminKit\Localizations\Database\Factories\LocalizationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Localization extends AbstractModel
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'key',
        'content',
    ];

    protected array $translatable = [
        'content',
    ];

    protected $table = 'admin_kit_localizations';

    protected static function newFactory(): LocalizationFactory
    {
        return new LocalizationFactory();
    }
}
