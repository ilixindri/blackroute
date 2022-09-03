<x-jet-form-section submit="save">
    <x-slot name="title">
        {{ __('Dados Pessoais') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Crie e altere os dados pessoais do cliente.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

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
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled"><!-- wire:target="photo">-->
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>