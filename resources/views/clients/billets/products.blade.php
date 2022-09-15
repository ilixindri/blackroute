<div id="list1" class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <ul id="ul1" class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab"
        role="tablist">
        <li id="li1"  class="nav-item" role="presentation">
            <a style="display: none" id="link1" href="#tabs-home" class="
      nav-link
      block
      font-medium
      text-xs
      leading-tight
      uppercase
      border-x-0 border-t-0 border-b-2 border-transparent
      px-6
      py-3
      my-2
      hover:border-transparent hover:bg-gray-100
      focus:border-transparent
      active
    " id="tabs-home-tab" data-bs-toggle="pill" data-bs-target="#tabs-home" role="tab" aria-controls="tabs-home"
               aria-selected="true">Home</a>
        </li>
    </ul>
    <div id="div1" class="tab-content" id="tabs-tabContent">
        <div style="display: none" class="tab-pane fade show active" id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab">
            Tab 1 content
        </div>
    </div>
    <div style="display: none" class="grid grid-cols-6 gap-6">
        <x-jet-label id="five" for="" />
        <div id="one" class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Nome') }}" />
            <x-jet-input required id="name" name="name" value="" type="text" class="mt-1 block w-full" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>
        <div id="two" class="col-span-6 sm:col-span-4">
            <x-jet-label for="amount" value="{{ __('Quantidade') }}" />
            <x-jet-input required id="amount" name="amount" min="1" value="" type="number" class="mt-1 block w-full" />
            <x-jet-input-error for="amount" class="mt-2" />
        </div>
        <div id="three" class="col-span-6 sm:col-span-4">
            <x-jet-label for="value" value="{{ __('Valor') }}" />
            <x-jet-input required id="value" name="value" value="" type="number" class="mt-1 block w-full" />
            <x-jet-input-error for="value" class="mt-2" />
        </div>
        <div id="four" class="py-3 col-span-6 sm:col-span-4"></div>
    </div>
    @isset($products)
        @php $count = 0; @endphp
        @foreach($products as $product)
            @php $count++; @endphp
            <div id="" class="grid grid-cols-6 gap-6">
                <x-jet-label for="name" value="{{ __('Produto :product', ['product' => $count]) }}" />
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Nome') }}" />
                    <x-jet-input required id="name" name="name" value="{{$product->name}}" type="text" class="mt-1 block w-full" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="amount" value="{{ __('Quantidade') }}" />
                    <x-jet-input required id="amount" name="amount" min="1" value="{{$product->quantity}}" type="number" class="mt-1 block w-full" />
                    <x-jet-input-error for="amount" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="value" value="{{ __('Valor') }}" />
                    <x-jet-input required id="value" name="value" type="number" value="{{$product->value}}" class="mt-1 block w-full" />
                    <x-jet-input-error for="value" class="mt-2" />
                </div>
            </div>
        @endforeach
        @endisset
</div>


{{-- @if (isset($actions1)) --}}
<div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
    <button style="cursor: pointer;" type="button" onclick="product(1)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
    value="Adicionar Mais um Produto">Adicionar Mais um Produto</button>
    <script>

        var lpc = 1;
        function product(param) {
            /* get element by id */
            var one = document.getElementById('one');
            one = one.cloneNode(true);
            one.id = '';
            var two = document.getElementById('two');
            two = two.cloneNode(true);
            two.id = '';
            var three = document.getElementById('three');
            three = three.cloneNode(true);
            three.id = '';
            var four = document.getElementById('four');
            four = four.cloneNode(true);
            four.id = '';
            // var five = document.getElementById('five');
            // five = five.cloneNode(true);
            // five.id = '';
            // five.innerHTML = "Produto " + lpc;
            // lpc++;
            var div = document.createElement('div');
            div.className = 'grid grid-cols-6 gap-6';
            if (param == 1) {
                // div.appendChild(four);
            }
            // var d = document.createElement('div');
            // d.className = 'col-span-6 sm:col-span-4';
            // d.appendChild(five);
            // div.appendChild(d);
            // var br = document.createElement('br');
            // div.appendChild(br);
            div.appendChild(one);
            div.appendChild(two);
            div.appendChild(three);

            var link1v = document.getElementById('link1');
            link1v.id = '';
            link1v.style = '';
            link1v.innerHTML = "Produto " + lpc;
            link1v.id = "tabs-product" + lpc + "-tab"
            link1v.setAttribute('data-bs-target', '#tabs-product'+lpc);
            link1v.setAttribute('aria-controls', 'tabs-product'+lpc);
            /* create element ul add class and role */
            var li1v = document.createElement('li');
            li1v.className = 'nav-item';
            li1v.setAttribute('role', 'presentation');
            li1v.appendChild(link1v)
            var ul1v = document.getElementById('ul1');
            ul1v.appendChild(li1v)

            var tab1v = document.createElement('div');
            tab1v.className = 'tab-pane fade show active';
            tab1v.id = "tabs-product" + lpc
            tab1v.setAttribute('role', 'tabpanel');
            tab1v.setAttribute('aria-labelledby', 'tabs-home-tab');
            tab1v.appendChild(div);

            for (let i = 0; i < lpc - 1; i++) {
                var idv = document.getElementById('tabs-product'+i);
                idv.className = 'tab-pane fade'
            }
            lpc++;

            var div1 = document.getElementById('div1');
            div1.appendChild(tab1v);
        }

        product(0)
    </script>


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
