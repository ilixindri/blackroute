<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="parcels" value="{{ __('Parcelas') }}" />
            @isset($bankingCarnet)
                <x-jet-input required id="parcels" value="{{$bankingCarnet->parcels}} " name="parcels" type="number" class="mt-1 block w-full"  autocomplete="parcels" />
            @else
                <x-jet-input required id="parcels" name="parcels" type="number" class="mt-1 block w-full"  autocomplete="parcels" />
            @endisset
            <x-jet-input-error for="parcels" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="fine" value="{{ __('Multa') }}" />
            @isset($bankingCarnet)<x-jet-input required id="fine" name="fine" value="{{$bankingCarnet->fine}}" type="number" class="mt-1 block w-full" />
            @else<x-jet-input required id="fine" name="fine" type="number" class="mt-1 block w-full" />@endisset
            <x-jet-input-error for="fine" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for=interest value="{{ __('Juros') }}" />
            @isset($bankingCarnet)<x-jet-input required id=interest name=interest value="{{$bankingCarnet->interest}}" type="number" class="mt-1 block w-full"  />
            @else<x-jet-input required id=interest name=interest type="number" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for=interest class="mt-2" />
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
    <a href="#" onclick="validate_personal_data()" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
        {{ __('Gerar Carnê') }}
    </a>
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
