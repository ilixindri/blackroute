<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div id="" class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="discount_type" value="{{ __('Tipo de Desconto') }}" />
                <x-jet-label style="float: left" class="px-2" for="discount_type" value="{{ __('Dinheiro') }}" />
                <x-jet-input style="float: left" class="px-3" required id="discount_type" name="discount_type" value="currency" type="radio" class="mt-1 block w-12" />
                <x-jet-label style="float: left" class="px-2" for="discount_type" value="{{ __('Porcentagem') }}" />
                <x-jet-input required id="discount_type" class="py-3" name="discount_type" value="percentage" type="radio" class="mt-1 block w-12" />
                <x-jet-input-error for="discount_type" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="discount_value" value="{{ __('Valor do Desconto') }}" />
                <x-jet-input required id="discount_value" name="discount_value" value="" type="number" class="mt-1 block w-full" />
                <x-jet-input-error for="discount_value" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 pt-4">
                <x-jet-label for="" title="Desconto por pagar antecipado" value="{{ __('Desconto Condicional') }}" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="conditional_discount_type" value="{{ __('Tipo de Desconto') }}" />
                <x-jet-label for="conditional_discount_type" value="{{ __('Dinheiro') }}" />
                <x-jet-input required id="conditional_discount_type" name="conditional_discount_type" value="currency" type="radio" class="mt-1 block w-full" />
                <x-jet-label for="conditional_discount_type" value="{{ __('Porcentagem') }}" />
                <x-jet-input required id="conditional_discount_type" name="conditional_discount_type" value="percentage" type="radio" class="mt-1 block w-full" />
                <x-jet-input-error for="conditional_discount_type" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="conditional_discount_value" value="{{ __('Valor do Desconto') }}" />
                <x-jet-input required id="conditional_discount_value" name="conditional_discount_value" value="" type="number" class="mt-1 block w-full" />
                <x-jet-input-error for="conditional_discount_value" class="mt-2" />
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

    {{-- <a href="#" onclick="validate_personal_data()" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
        {{ __('Gerar Carnê') }}
    </a> --}}
    <input id="submit" name="submit" value="{{ __('Gerar Boleto') }}" type="submit" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
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
