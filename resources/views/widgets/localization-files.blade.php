<x-filament::widget>
    <x-filament::section>
        <div class="flex gap-4">
            @foreach(AdminKit::locales() as $locale)
                <div
                        class="flex flex-col gap-2 items-center w-full cursor-pointer dark:hover:bg-white/5 py-4 rounded-xl transition-colors"
                        wire:click="downloadTranslationFile('{{$locale}}')">
                    <x-filament::icon-button
                            icon="heroicon-o-arrow-down-tray"
                            size="xl"
                    />
                    <span class="font-bold text-sm">{{$locale}}.json</span>
                    <span class="text-custom-400 text-xs" style="--c-400: var(--primary-400);">
                        {{$exists[$locale] ? $sizes[$locale] : '0.00 Kb'}}
                    </span>
                    <x-filament::badge>
                        {{$exists[$locale] ? $counts[$locale] : __('admin-kit-localizations::localizations.not_created')}}
                    </x-filament::badge>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament::widget>
