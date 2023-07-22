<?php

namespace AdminKit\Localizations\Database\Factories;

use AdminKit\Core\Facades\AdminKit;
use AdminKit\Localizations\Models\Localization;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocalizationFactory extends Factory
{
    protected $model = Localization::class;

    public function definition()
    {
        $content = [];
        foreach (AdminKit::locales() as $locale) {
            $content[$locale] = $this->faker->realText(30);
        }

        return [
            'key' => $this->faker->unique()->slug(1),
            'content' => $content,
        ];
    }
}
