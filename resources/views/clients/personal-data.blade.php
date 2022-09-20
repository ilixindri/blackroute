@include('form-section')

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
            {{ __('Avançar') }}
        </a>
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
