@include('form-section')

<div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
    {{-- <x-jet-action-message class="mr-3" on="saved">
        {{ __('Saved.') }}
    </x-jet-action-message> --}}

    {{-- <x-jet-button wire:loading.attr="disabled"><!-- wire:target="photo">-->
        {{ __('Save') }}
    </x-jet-button> --}}
    {{-- <a href="#" onclick="section1()" class='mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
        {{ __('Voltar') }}
    </a> --}}
    <input id="submit" name="submit" style="cursor: pointer" value="{{ __('Salvar') }}" type="submit"
           class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
    <script>
        document.getElementById('submit').addEventListener(
            'click', submit, false
        );

        function submit(evt) {
            // document.getElementById('message_div').style.display = 'none';
            var fields = @array($displayable);
            var labels = @array(array_filter($displayable, function ($index) {
                return $Model->($index.'__datas')['label']
            }));
            // var maxs = @array(array_filter($displayable, function ($index) {
            //     return isset($Model->$index['max']) ? $Model->($index.'__datas'
            // )
            //     ['max']
            // :
            //     False
            // }));
            // var mins = @array(array_filter($displayable, function ($index) {
            //     return isset($Model->$index['min']) ? $Model->($index.'__datas'
            // )
            //     ['min']
            // :
            //     False
            // }));
            for (var i = 0; i < fields.length; i++) {
                e = document.getElementById(fields[i]);
                if (e.value == '' || e.value == 'None') {
                    document.getElementById('message_div').style.display = 'block';
                    document.getElementById('message').innerHTML = 'Campo ' + labels[i] + ' obrigatório.';
                    evt.preventDefault();
                    return;
                } else if (parseInt(e.value, 10) > maxs[i] || parseInt(e.value, 10) < mins[i]) {
                    document.getElementById('message_div').style.display = 'block';
                    document.getElementById('message').innerHTML = 'Campo ' + labels[i] + ' obrigatório.';
                    evt.preventDefault();
                    return;
                }
            }
            /* submit form */
            document.getElementById('form').submit();
        }
    </script>
</div>
