@php
    $strings = explode('\\', $getRecord()->subject_type);
    $strings = $strings[count($strings) - 1];
@endphp

<div class="space-y-6">
    <div @class([ 'space-y-2 bg-white rounded-xl' , 'dark:border-gray-600 dark:bg-gray-800' , ])>
        <div class="p-2">
            <div class="flex justify-between">
                <div class="flex items-center gap-4">
                    <x-filament-panels::avatar.user class="!w-7 !h-7" />
                    <div class="flex flex-col text-left">
                        <div class="flex items-center gap-1">
                            <span class="font-bold">{{ $getRecord()->causer->name }}</span>
                            <span class="text-xs text-gray-500">({{ $getRecord()->causer->email }})</span>
                        </div>
                        <span class="text-xs text-gray-500">
                            {{ Str::ucfirst($getRecord()->event) }} | {{ $strings }} | {{ $getRecord()->created_at->format('Y-m-d, H:i:s') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <x-filament-tables::table class="w-full overflow-hidden text-sm">
            <x-slot:header>
                <x-filament-tables::header-cell>
                    Field
                </x-filament-tables::header-cell>
                @if (isset($getRecord()->properties['old']) && isset($getRecord()->properties['attributes']))
                <x-filament-tables::header-cell>
                    Old
                </x-filament-tables::header-cell>
                <x-filament-tables::header-cell>
                    New
                </x-filament-tables::header-cell>
                @elseif (isset($getRecord()->properties['attributes']))
                <x-filament-tables::header-cell>
                    New
                </x-filament-tables::header-cell>
                @else
                <x-filament-tables::header-cell>
                    Old
                </x-filament-tables::header-cell>
                @endif
            </x-slot:header>
            @if (isset($getRecord()->properties['old']) && isset($getRecord()->properties['attributes']))
            @foreach ($getRecord()->properties['old'] as $key => $old)
            <x-filament-tables::row>
                <x-filament-tables::cell width="20%" class="px-4 py-2 align-top sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                    {{ $key }}
                </x-filament-tables::cell>
                <x-filament-tables::cell width="40%" class="px-4 py-2 align-top break-all whitespace-normal">
                    {{ $old }}
                </x-filament-tables::cell>
                <x-filament-tables::cell width="40%" class="px-4 py-2 align-top break-all whitespace-normal">
                    {{ $getRecord()->properties['attributes'][$key] }}
                </x-filament-tables::cell>
            </x-filament-tables::row>
            @endforeach
            @elseif (isset($getRecord()->properties['attributes']))
            @foreach ($getRecord()->properties['attributes'] as $key => $attributes)
            <x-filament-tables::row>
                <x-filament-tables::cell width="20%" class="px-4 py-2 align-top sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                    {{ $key }}
                </x-filament-tables::cell>
                <x-filament-tables::cell width="40%" class="px-4 py-2 align-top break-all whitespace-normal">
                    {{ $attributes }}
                </x-filament-tables::cell>
            </x-filament-tables::row>
            @endforeach
            @else
            @foreach ($getRecord()->properties['old'] as $key => $old)
            <x-filament-tables::row>
                <x-filament-tables::cell width="20%" class="px-4 py-2 align-top sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                    {{ $key }}
                </x-filament-tables::cell>
                <x-filament-tables::cell width="40%" class="px-4 py-2 align-top break-all whitespace-normal">
                    {{ $old }}
                </x-filament-tables::cell>
            </x-filament-tables::row>
            @endforeach
            @endif
        </x-filament-tables::table>
    </div>
</div>
