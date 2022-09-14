<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="sanbox" title="Selecionado faz com que o boleto gerado não seja real e apenas um teste." value="{{ __('Sandox') }}" />
            @isset($billets)
            @if($billets->sanbox == 1 || $client->banking->sandbox == 1)
                <x-jet-checkbox checked required id="sanbox" name="sanbox" class="py-3 mt-1 block w-full"  autocomplete="sanbox" />
            @endif
            @endisset
                <x-jet-checkbox required id="sanbox" name="sanbox" class="py-3 mt-1 block w-full" autocomplete="sanbox" />
            <x-jet-input-error for="sanbox" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="banking_id" value="{{ __('Banco') }}" />
            <select required id="banking_id" name="banking_id" class='border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                <option value="None"></option>
                @foreach($bankings as $banking)
                    <option @if($banking->id == $client->banking->id) selected @endif value="{{ $banking->id }}">{{ $banking->type__datas['label'] }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="banking" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="fine" value="{{ __('Multa') }}" />
            @isset($bankingCarnet)<x-jet-input required id="fine" name="fine" value="{{$billet->fine}}" type="number" class="mt-1 block w-full" />
            @else<x-jet-input required id="fine" name="fine" type="number" class="mt-1 block w-full" />@endisset
            <x-jet-input-error for="fine" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="interest" value="{{ __('Juros') }}" />
            @isset($bankingCarnet)<x-jet-input required id="interest" name="interest" value="{{$billet->interest}}" type="number" class="mt-1 block w-full"  />
            @else<x-jet-input required id="interest" name="interest" type="number" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="interest" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="expire_at" value="{{ __('Data de Vencimento') }}" />
            @isset($bankingCarnet)<x-jet-input required id="expire_at" name="expire_at" value="{{$billet->expire_at}}" type="date" class="mt-1 block w-full"  />
            @else<x-jet-input required id="expire_at" name="expire_at" type="date" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="expire_at" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="message" value="{{ __('Mensagem a colocar no boleto') }}" />
            @isset($bankingCarnet)<x-jet-input required id="message" name="message" value="{{$billet->expire_at}}" type="date" class="mt-1 block w-full"  />
            @else<x-jet-input required id="message" name="message" type="text" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="message" class="mt-2" />
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
    {{-- <x-jet-label id="verification_personal_data"></x-jet-label> --}}

    {{-- <a href="#" onclick="validate_personal_data_()" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
        {{ __('Gerar Carnê') }}
    </a> --}}
    <script>
        function validate_personal_data(params) {
            document.getElementById('verification_personal_data').innerHTML = '';
            var arr = ['parcels', 'fine', 'interest'];
            for (var i = 0; i < arr.length; i++) {
                e = document.getElementById(arr[i]);
                if (e.value == '' || e.value == 'None') {
                    document.getElementById('verification_personal_data').innerHTML = 'Campo ' + arr[i] + ' obrigatório. &nbsp;';
                    // evt.preventDefault();
                    return;
                } else if (arr[i] == 'email') {
                    /* check if is email */
                    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
                    if (!emailRegex.test(e.value)) {
                        document.getElementById('verification_personal_data').innerHTML = 'Deve ser um email válido no formato username@provider. &nbsp;';
                        // evt.preventDefault();
                        return;
                    }
                } else if (arr[i] == 'data_nascimento') {
                    /* split date and get year */
                    // console.log(e.value);
                    var date = e.value;
                    var dateParts = date.split('-');
                    var year = dateParts[0];
                    /* check if year has four digits */
                    if (year.length != 4) {
                        document.getElementById('verification_personal_data').innerHTML = 'O ano da data precisa ter 4 dígitos. &nbsp;';
                        // evt.preventDefault();
                        return;
                    }
                }
            }
            document.getElementById('form').submit();
        }
    </script>
</div>
{{-- @endif --}}
