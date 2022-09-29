@include('form-section')

<script>

</script>

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
