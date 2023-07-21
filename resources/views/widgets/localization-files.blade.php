<x-filament::widget>
    <x-filament::card>
        {{-- Widget content --}}
        @foreach(AdminKit::locales() as $locale)
            <x-filament-support::button wire:click="downloadTranslationFile('{{$locale}}')">
                {{ $locale }}.json
            </x-filament-support::button>
        @endforeach
    </x-filament::card>
</x-filament::widget>
