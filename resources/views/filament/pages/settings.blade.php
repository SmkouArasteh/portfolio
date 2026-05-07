<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            Save Settings
        </x-filament::button>
    </x-filament-panels::form>
</x-filament-panels::page>
