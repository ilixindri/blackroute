<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
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
            @isset($client)
                <x-jet-input required id="name" value="{{$client->nome}} " name="name" type="text" class="mt-1 block w-full"  autocomplete="name" />
            @else
                <x-jet-input required id="name" name="name" type="text" class="mt-1 block w-full"  autocomplete="name" />
            @endisset
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            @isset($client)<x-jet-input required id="email" name="email" value="{{$client->email}}" type="email" class="mt-1 block w-full" />
            @else<x-jet-input required id="email" name="email" type="email" class="mt-1 block w-full" />@endisset
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- RG -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="rg" value="{{ __('RG') }}" />
            @isset($client)<x-jet-input required id="rg" name="rg" value="{{$client->rg}}" type="text" class="mt-1 block w-full"  />
            @else<x-jet-input required id="rg" name="rg" type="text" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="rg" class="mt-2" />
        </div>

        <!-- CPF -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="cpf" value="{{ __('CPF') }}" />
            @isset($client)<x-jet-input required id="cpf" name="cpf" value="{{$client->cpf}}" type="text" class="mt-1 block w-full"  />
            @else<x-jet-input required id="cpf" name="cpf" type="text" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="cpf" class="mt-2" />
        </div>
        <!-- Telefone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone" value="{{ __('Telefone') }}" />
            @isset($client)<x-jet-input required id="phone" name="phone" value="{{$client->phone}}" type="text" class="mt-1 block w-full"  />
            @else<x-jet-input required id="phone" name="phone" type="text" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="phone" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="whatsapp" value="{{ __('Whatsapp') }}" />
            @isset($client)<x-jet-input required id="whatsapp" name="whatsapp" value="{{$client->whatsapp}}" type="text" class="mt-1 block w-full"  />
            @else<x-jet-input required id="whatsapp" name="whatsapp" type="text" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="whatsapp" class="mt-2" />
        </div>
        <!-- Telefone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="data_nascimento" value="{{ __('Data de Nascimento') }}" />
            @isset($client)<x-jet-input required id="data_nascimento" name="data_nascimento" value="{{$client->data_nascimento}}" type="date" class="mt-1 block w-full"  />
            @else<x-jet-input required id="data_nascimento" name="data_nascimento" type="date" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="data_nascimento" class="mt-2" />
        </div>
        <!-- Telefone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="sexo" value="{{ __('Sexo') }}" />
            <select required id="sexo" name="sexo" class='border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                <option value="None" selected></option>
                <option @isset($client)@if($client->sexo=="Feminino") selected @endif @endisset value="Feminino">Feminino</option>
                <option @isset($client)@if($client->sexo=="Masculino") selected @endif @endisset value="Masculino">Masculino</option>
            </select>
        <x-jet-input-error for="sexo" class="mt-2" />
        </div>
    </div>
</div>

{{-- @if (isset($actions1)) --}}
    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
        {{-- <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message> --}}

        {{-- <x-jet-button wire:loading.attr="disabled"><!-- wire:target="photo">-->
            {{ __('Save') }}
        </x-jet-button> --}}
        <x-jet-label id="verification_personal_data"></x-jet-label>
        <a href="#" onclick="section2()" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
            {{ __('Avançar') }}
        </a>
        <script>
            function validate_personal_data(params) {
                
            }
        </script>
    </div>
{{-- @endif --}}