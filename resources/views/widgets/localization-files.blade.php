<x-filament::widget>
    <x-filament::card>
        {{-- Widget content --}}
        @foreach(AdminKit::locales() as $locale)
            <p>
                {{Str::upper($locale)}} - {{__('admin-kit-localizations::localizations.translation_file')}}
                @if ($exists[$locale])
                    <span class="hover:underline cursor-pointer font-bold"
                          wire:click="downloadTranslationFile('{{$locale}}')">{{$locale}}.json</span>
                    ({{$size[$locale]}}), {{$count[$locale]}}.
                @else
                    <b>{{$locale}}.json</b> {{__('admin-kit-localizations::localizations.not_created')}}
                @endif
            </p>
        @endforeach
    </x-filament::card>
</x-filament::widget>

<style>

</style>
