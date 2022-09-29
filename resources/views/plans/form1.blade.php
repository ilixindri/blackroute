<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Nome') }}" />
            @isset($plan)
                <x-jet-input required id="name" value="{{$plan->name}} " name="name" type="text" class="mt-1 block w-full"  autocomplete="name" />
            @else
                <x-jet-input required id="name" name="name" type="text" class="mt-1 block w-full"  autocomplete="name" />
            @endisset
            <x-jet-input-error for="name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="value" value="{{ __('Valor') }}" />
            @isset($plan)<x-jet-input required id="value" name="value" value="{{$plan->value}}" type="number" class="mt-1 block w-full" />
            @else<x-jet-input required id="value" name="value" type="number" class="mt-1 block w-full" />@endisset
            <x-jet-input-error for="value" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="until_days" value="{{ __('Dias Antes Para Desconto') }}" />
            @isset($plan)<x-jet-input required id="until_days" name="until_days" value="{{$plan->until_days}}" type="text" class="mt-1 block w-full"  />
            @else<x-jet-input required id="until_days" name="until_days" type="text" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="until_days" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4" style="display:none;">
            <x-jet-label for="conditional_discount_type" value="{{ __('Tipo de Desconto') }}" />
            <div class="pt-3">
                <x-jet-label style="float: left" class="px-2" for="conditional_discount_type" value="{{ __('Dinheiro') }}" />
                <x-jet-input style="float: left" class="px-3" required id="conditional_discount_type" name="conditional_discount_type" value="currency" type="radio" class="mt-1 block w-12" />
                <x-jet-label style="float: left" class="px-2" for="conditional_discount_type" value="{{ __('Porcentagem') }}" />
                <x-jet-input required class="" checked id="conditional_discount_type" name="conditional_discount_type" value="percentage" type="radio" class="mt-1 block w-12" />
            </div>
            <x-jet-input-error for="conditional_discount_type" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="conditional_discount_value" value="{{ __('Valor do Desconto') }}" />
            @isset($plan) <x-jet-input required id="conditional_discount_value" name="conditional_discount_value"
                         value="{{$plan->conditional_discount_value}}"  type="number" class="mt-1 block w-full" />
            @else
                <x-jet-input required id="conditional_discount_value" name="conditional_discount_value"
                             value=""  type="number" class="mt-1 block w-full" />
            @endisset
            <x-jet-input-error for="conditional_discount_value" class="mt-2" />
        </div>
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
    <button type="submit" href="#" onclick="" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
        {{ __('Avançar') }}
    </button>
    <script>
        function validate_personal_data(params) {
            document.getElementById('verification_personal_data').innerHTML = '';
            var arr = ['name', 'birth_date', 'sexo', 'email', 'rg', 'cpf', 'phone', 'whatsapp'];
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
            section2();
        }
    </script>
</div>
{{-- @endif --}}
