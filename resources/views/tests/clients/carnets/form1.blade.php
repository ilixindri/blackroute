<div
{{--    class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">--}}
    <div class="grid grid-cols-6 gap-6">
{{--        @php $displayable = []; @endphp--}}
{{--        @php--}}
//        $i = 0;
//            dd($Model);
{{--        @endphp--}}
        @foreach($Model->getFillable() as $field)
{{--        @foreach($Model->displayable() as $field)--}}
            @php
//            $i++;
//            if ($i > 3){
//                break;
//            }
                try {
//            echo $field;
//            exit();
            if ($Model->{$field.'__datas'}["type"] == "text") { @endphp

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="{{ $field }}" value="{{ __($Model->{$field.'__datas'}['label']) }}"/>
                    <x-jet-input required id="{{ $field }}" oninput="" name="{{ $field }}" @isset($bankingCarnet) value="{{ $bankingCarnet->$field }}" @endisset
                                 type="text" class="mt-1 block w-full" autocomplete="name"/>
                    <x-jet-input-error for="{{ $field }}" class="mt-2"/>
                </div>
            @php } else if ($Model->{$field.'__datas'}["type"] == "select") { @endphp
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="{{ $field }}" value="{{ __($Model->{$field.'__datas'}['label']) }}"/>
                    <select required id="{{ $field }}" name="{{ $field }}"
                            class='border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                        <option value="None"></option>
                        @foreach($Model->{$field.'__datas'}['options'] as $option)
                            <option @isset($bankingCarnet) @if($option["value"] == $bankingCarnet->$field) selected
                                    @endif @endisset value="{{ $option["value"] }}">{{ $option["text"] }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="{{ $field }}" class="mt-2"/>
                </div>
            @php } else if ($Model->{$field.'__datas'}["type"] == "number") { @endphp
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="{{ $field }}" value="{{ __($Model->{$field.'__datas'}['label']) }}"/>
                    <x-jet-input required id="{{ $field }}" oninput="" name="{{ $field }}" @isset($bankingCarnet) value="{{ $bankingCarnet->$field }}" @endisset
                                 type="number" class="mt-1 block w-full" autocomplete="{{ $field }}"/>
                    <x-jet-input-error for="{{ $field }}" class="mt-2"/>
                </div>
            @php $displayable[] = $field;}
                } catch (exception $e) {
//                    echo $e->getTraceAsString();
//                    echo $e->getMessage();
//                    exit();
                    //echo $field;
                    }
            @endphp
        @endforeach
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="fine" value="Multa"/>
            <x-jet-input required id="fine" oninput="" name="fine" @isset($bankingCarnet) value="{{ $bankingCarnet->$field }}" @endisset
            type="number" class="mt-1 block w-full" autocomplete="fine"/>
            <x-jet-input-error for="fine" class="mt-2"/>
        </div>
        @php
//        dd($displayable);
//        exit();
            @endphp
    </div>
</div>

<div
    class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
    {{-- <x-jet-action-message class="mr-3" on="saved">
        {{ __('Saved.') }}
    </x-jet-action-message> --}}

    {{-- <x-jet-button wire:loading.attr="disabled"><!-- wire:target="photo">-->
        {{ __('Save') }}
    </x-jet-button> --}}
    {{-- <x-jet-label id="verification_address"></x-jet-label> --}}
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
