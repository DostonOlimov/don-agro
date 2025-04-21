<x-filament::page>
    <x-filament::card>
        <h2 class="text-2xl font-semibold">Manage Location Resources</h2>

        <ul>
            <li>
                <a href="{{ route('filament.resources.states.index') }}" class="text-blue-500">States</a>
            </li>
            <li>
                <a href="{{ route('filament.resources.regions.index') }}" class="text-blue-500">Regions</a>
            </li>
        </ul>
    </x-filament::card>
</x-filament::page>
