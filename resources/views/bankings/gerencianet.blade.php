<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        @forelse ($bankings as $banking)
            @foreach($Model->getFillable() as $field)
                {{$field}}
                {{$Model->$field["type"]}}
                {{$Model->$field['label']}}
                @if($Model->$field["type"] == "text")
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="{{ $field }}" value="{{ __($Model->$field['label']) }}" />
                            @if(count($bankings) != 0) @php echo "fim";
                            exit();
                        @endphp <x-jet-input required id="{{ $field }}" oninput="" name="{{ $field }}" value="{{$bankings[0]->$field}}" type="text" class="mt-1 block w-full" autocomplete="name" />
                                    
                                @else<x-jet-input required id="{{ $field }}" oninput="" name="{{ $field }}" type="text" class="mt-1 block w-full" autocomplete="name" />@endif
                        <x-jet-input-error for="{{ $field }}" class="mt-2" />
                    </div>
                @endif
            @endforeach
        @empty
                    ok
            @foreach($Model->getFillable() as $field)
                {{$field}}
                {{$Model->$field["type"]}}
                {{$Model->$field['label']}}
                @if($Model->$field["type"] == "text")
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="{{ $field }}" value="{{ __($Model->$field['label']) }}" />
                        <x-jet-input required id="{{ $field }}" oninput="" name="{{ $field }}" type="text" class="mt-1 block w-full" autocomplete="name" />
                        <x-jet-input-error for="{{ $field }}" class="mt-2" />
                    </div>
                @endif
                @php
                exit();
            @endphp
           @endforeach
        @endforelse
    </div>
</div>

<div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
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
    <input id="submit" name="submit" value="{{ __('Salvar') }}" type="submit" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
    <script>
        document.getElementById('submit').addEventListener(
            'click', submit, false
        );
        function submit(evt) {
            var arr = [];
            @foreach($Model->getFillable() as $field)
                arr.push('{{ $field }}');
            @endforeach
            for (var i = 0; i < arr.length; i++) {
                e = document.getElementById(arr[i]);
                if (e.value == '' || e.value == 'None') {
                    document.getElementById('message_div').style.display = 'block';
                    document.getElementById('message').innerHTML = 'Campo ' + arr[i] + ' obrigatório.';
                    evt.preventDefault();
                    return;
                }
            }
            /* submit form */
            document.getElementById('client').submit();
        }
    </script>
</div>
