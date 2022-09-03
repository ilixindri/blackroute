<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cliente') }}
        </h2>
    </x-slot>

    <livewire:flash-container />

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @isset($this->cliente)
                <livewire:clientes.edit-information-form :cliente="$cliente"></livewire:clientes.edit-information-form>
            @else
                {{-- @livewire('clientes.information-form') --}}
                {{-- @include('clientes.information-form'); --}}
                <livewire:clientes.create-information-form></livewire:clientes.create-information-form>
            @endisset

            <x-jet-section-border />
        </div>
    </div>
</x-app-layout>