<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Nome') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="nome" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model="email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- RG -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="rg" value="{{ __('RG') }}" />
            <x-jet-input id="rg" type="text" class="mt-1 block w-full" wire:model="rg" />
            <x-jet-input-error for="rg" class="mt-2" />
        </div>

        <!-- CPF -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="cpf" value="{{ __('CPF') }}" />
            <x-jet-input id="cpf" type="text" class="mt-1 block w-full" wire:model="cpf" />
            <x-jet-input-error for="cpf" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone" value="{{ __('Telefone') }}" />
            <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model="phone" />
            <x-jet-input-error for="phone" class="mt-2" />
        </div>

        <!-- Whatsapp -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="whatsapp" value="{{ __('Whatsapp') }}" />
            <x-jet-input id="whatsapp" type="text" class="mt-1 block w-full" wire:model="whatsapp" />
            <x-jet-input-error for="whatsapp" class="mt-2" />
        </div>

        <!-- Data de Nascimento -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="data_nascimento" value="{{ __('Data de Nascimento') }}" />
            <x-jet-input id="data_nascimento" type="date" class="mt-1 block w-full" wire:model="data_nascimento" />
            <x-jet-input-error for="data_nascimento" class="mt-2" />
        </div>

        <!-- Sexo -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="sexo" value="{{ __('Sexo') }}" />
            <x-jet-input id="sexo" type="text" class="mt-1 block w-full" wire:model="sexo" />
            <x-jet-input-error for="sexo" class="mt-2" />
        </div>
    </div>
</div>

@if (isset($actions1))
    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled"><!-- wire:target="photo">-->
            {{ __('Save') }}
        </x-jet-button>
    </div>
@endif