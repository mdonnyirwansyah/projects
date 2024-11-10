<x-filament-panels::page>
    <div class="space-y-6">
            <div @class([
                'p-2 space-y-2 bg-white rounded-xl shadow',
                'dark:border-gray-600 dark:bg-gray-800',
            ])>
            <div class="p-2">
                <div class="flex justify-between">
                    <div class="flex items-center gap-4">
                        <x-filament-panels::avatar.user class="!w-7 !h-7"/>
                        <div class="flex flex-col text-left">
                            <span class="font-bold">Jhon</span>
                            <span class="text-xs text-gray-500">
                                Updated 2024-10-20, 10:00:00
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
                    <x-filament-tables::header-cell>
                        Old
                    </x-filament-tables::header-cell>
                    <x-filament-tables::header-cell>
                        New
                    </x-filament-tables::header-cell>
                </x-slot:header>
                        <x-filament-tables::row>
                            <x-filament-tables::cell width="20%" class="px-4 py-2 align-top sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                Test
                            </x-filament-tables::cell>
                            <x-filament-tables::cell width="40%" class="px-4 py-2 align-top break-all whitespace-normal">
                                Test
                            </x-filament-tables::cell>
                            <x-filament-tables::cell width="40%" class="px-4 py-2 align-top break-all whitespace-normal">
                                Test
                            </x-filament-tables::cell>
                        </x-filament-tables::row>
            </x-filament-tables::table>
        </div>
    </div>
</x-filament-panels::page>
