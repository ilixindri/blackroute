<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="type" value="{{ __('Tipo') }}" />
            <select required id="type" name="type" class='border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                <option value="None" selected></option>
                <option @isset($client)@if($client->enderecos[0]->tipo=="Comercial") selected @endif @endisset value="Comercial">Comercial</option>
                <option @isset($client)@if($client->enderecos[0]->tipo=="Residencial") selected @endif @endisset value="Residencial">Residencial</option>
            </select>
        <x-jet-input-error for="type" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="zip" value="{{ __('CEP') }}" />
            @isset($client)<x-jet-input required id="zip" oninput="cep(this)" name="zip" value="{{$client->enderecos[0]->cep}}" type="text" class="mt-1 block w-full" autocomplete="name" />
            @else<x-jet-input required id="zip" oninput="cep(this)" name="zip" type="text" class="mt-1 block w-full" autocomplete="name" />@endisset
            <x-jet-input-error for="zip" class="mt-2" />
        </div>
        <script>
            function cep(e) {
                let c = e.value.replace(/[^0-9]/g, '');
                if (c.length == 8) {
                    document.getElementById('logradouro').value = "{{ __('carregando...') }}";
                    document.getElementById('bairro').value = "{{ __('carregando...') }}";
                    document.getElementById('uf').value = "{{ __('carregando...') }}";
                    /* request GET */
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'https://viacep.com.br/ws/' + c + '/json/', true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4) {
                            var response = JSON.parse(xhr.responseText);
                            document.getElementById('logradouro').value = response.logradouro;
                            document.getElementById('bairro').value = response.bairro;
                            document.getElementById('uf').value = response.localidade + ' - ' + response.uf;
                        }
                    };
                    xhr.send();
                }
            }
        </script>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="logradouro" value="{{ __('Logradouro') }}" />
            @isset($client)<x-jet-input required id="logradouro" name="logradouro" value="{{$client->enderecos[0]->logradouro}}" type="text" class="mt-1 block w-full"/>
            @else<x-jet-input required id="logradouro" name="logradouro" type="text" class="mt-1 block w-full" />@endisset
            <x-jet-input-error for="logradouro" class="mt-2" />
        </div>

        <!-- RG -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="number" value="{{ __('Número') }}" />
            @isset($client)<x-jet-input required id="number" name="number" type="text" value="{{$client->enderecos[0]->numero}}" class="mt-1 block w-full"/>
            @else<x-jet-input required id="number" name="number" type="text" class="mt-1 block w-full" />@endisset
            <x-jet-input-error for="number" class="mt-2" />
        </div>

        <!-- CPF -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="complemento" value="{{ __('Complemento') }}" />
            @isset($client)<x-jet-input required id="complemento" name="complemento" type="text" value="{{$client->enderecos[0]->complemento}}" class="mt-1 block w-full"/>
            @else<x-jet-input required id="complemento" name="complemento" type="text" class="mt-1 block w-full"/>@endisset
            <x-jet-input-error for="complemento" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="bairro" value="{{ __('Bairro') }}" />
            @isset($client)<x-jet-input required id="bairro" name="bairro" type="text" value="{{$client->enderecos[0]->bairro}}" class="mt-1 block w-full"/>
            @else<x-jet-input required id="bairro" name="bairro" type="text" class="mt-1 block w-full"/>@endisset
            <x-jet-input-error for="bairro" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="uf" value="{{ __('UF') }}" />
            @isset($client)<x-jet-input required id="uf" name="uf" type="text" value="{{$client->enderecos[0]->UF}}" class="mt-1 block w-full"/>
            @else<x-jet-input required id="uf" name="uf" type="text" class="mt-1 block w-full"/>@endisset
            <x-jet-input-error for="uf" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="coordinates" value="{{ __('Coordenadas') }}" />
            @isset($client)<x-jet-input required id="coordinates" name="coordinates" type="text" value="{{$client->enderecos[0]->coordinates}}" class="mt-1 block w-full"/>
            @else<x-jet-input required id="coordinates" name="coordinates" type="text" class="mt-1 block w-full"/>@endisset
            <a href="#" onclick="" class='m-2 py-1 mr-2 inline-flex items-center px-1 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white  tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
                {{ __('Verificar Coordenadas') }}
            </a>
            <x-jet-input-error for="uf" class="mt-2" />
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
        <x-jet-label id="verification_address"></x-jet-label>
        <a href="#" onclick="section1()" class='mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
            {{ __('Voltar') }}
        </a>
        <input id="submit" name="submit" value="{{ __('Salvar') }}" type="submit" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
        <script>
            document.getElementById('submit').addEventListener(
                'click', submit, false
            );
            function submit(evt) {
                document.getElementById('verification_address').innerHTML = '';
                var arr = ['zip', 'logradouro', 'number', 'uf', 'complemento', 'bairro', 'type'];
                for (var i = 0; i < arr.length; i++) {
                    e = document.getElementById(arr[i]);
                    if (e.value == '' || e.value == 'None') {
                        document.getElementById('verification_address').innerHTML = 'Campo ' + arr[i] + ' obrigatório. &nbsp;';
                        evt.preventDefault();
                        return;
                    }
                }
                /* submit form */
                document.getElementById('client').submit();
            }
        </script>
    </div>
{{-- @endif --}}