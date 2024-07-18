<?php

namespace AdminKit\Localizations\Models;

use AdminKit\Core\Abstracts\Models\AbstractModel;
use AdminKit\Localizations\Actions\LocalizationCacheForgetAction;
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

    protected static function boot()
    {
        parent::boot();

        self::created(function () {
            app(LocalizationCacheForgetAction::class)->run();
        });

        self::updated(function () {
            app(LocalizationCacheForgetAction::class)->run();
        });

        self::deleted(function () {
            app(LocalizationCacheForgetAction::class)->run();
        });
    }

    protected static function newFactory(): LocalizationFactory
    {
        return new LocalizationFactory();
    }
}
