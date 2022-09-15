<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        @isset($billet)
        @else
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="quantity" value="{{ __('Quantidade') }}" />
{{--                <x-jet-input required id="quantity" min="0" name="quantity" value="" type="number" class="mt-1 block w-full"  />--}}
{{--                <input type="search" id="quantity" list="quantities" placeholder="" class="mt-1 block w-full">--}}
                <x-jet-input  required id="quantity" min="1" name="quantity" list="quantities" value="" type="search" class="mt-1 block w-full"  />
                <datalist id="quantities" class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1  w-full">
                </datalist>
                <script>
                    var d = document.getElementById('quantities');
                    d.style.width = '100%';
                    d.style.height = '100%';
                    for (let i = 1; i != 25; i++) {
                        var optionv = document.createElement('option');
                        optionv.value = i;
                        d.appendChild(optionv);
                    }
                </script>
                <x-jet-input-error for="quantity" class="mt-2" />
            </div>
        @endisset
        <div style="display: none" class="col-span-6 sm:col-span-4">
            <x-jet-label for="sanbox" title="Selecionado faz com que o boleto gerado não seja real e apenas um teste." value="{{ __('Sandox') }}" />
            @isset($billets)
                @if($billets->sanbox == 1)
                    <x-jet-checkbox checked  id="sanbox" name="sanbox" class="py-5 mt-1 block w-full"  autocomplete="sanbox" />
                @else
                    <x-jet-checkbox  id="sanbox" name="sanbox" class="py-5 mt-1 block w-full"  autocomplete="sanbox" />
                @endif
            @else
                @if($client->banking->sandbox == 1)
                    <x-jet-checkbox checked onclick="sandbox(this)"  id="sanbox" name="sanbox" class="py-5 mt-1 block w-full" autocomplete="sanbox" />
                @else
                    <x-jet-checkbox onclick="sandbox(this)"  id="sanbox" name="sanbox" class="py-5 mt-1 block w-full" autocomplete="sanbox" />
                @endif
            @endisset
            <script>
                function sandbox(e) {
                    if (e.checked) {
                        if (!confirm('Com esse campo ativado o boleto gerado será apenas para teste.')) {
                            e.checked = false;
                        }
                    }
                }
            </script>
            <x-jet-input-error for="sanbox" class="mt-2" />
        </div>
        <div style="display: none" class="col-span-6 sm:col-span-4">
            <x-jet-label for="banking_id" value="{{ __('Banco') }}" />
            <select required id="banking_id" name="banking_id" class='border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                <option value="None"></option>
                @foreach($bankings as $banking)
                    <option @if($banking->id == $client->banking->id) selected @endif value="{{ $banking->id }}">{{ $banking->type__datas['label'] }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="banking" class="mt-2" />
        </div>
        <div style="display: none" class="col-span-6 sm:col-span-4">
            <x-jet-label for="fine" value="{{ __('Multa') }}" />
            @isset($billet)<x-jet-input  id="fine" min="0" name="fine" value="{{$billet->fine}}" type="number" class="mt-1 block w-full" />
            @else<x-jet-input onclick="finei(this)" min="0" oninput="ii(this, 'fine')" style="float: left" value="{{ $client->banking->fine }}"
                 id="fine" name="fine" type="number" class="mt-1 block w-24" />@endisset
            <x-jet-checkbox style="float: right" checked onclick="cf(this, 'fine')" required id="finec" name="finec" class="py-5 mt-1 block w-12" autocomplete="sanbox" />
            <x-jet-label class="py-4 px-2" style="float: right" for="finec" value="{{ __('Usar Multa Default Da Conta:') }}" />
            <script>
                var v = {'fine': '', 'interest': ''};
                var f = true;
                function ii(e, c) {
                    let input = document.getElementById(c);
                    v[c] = input.value;
                    f = false;
                    let cb = document.getElementById(c+'c');
                    cb.checked = false;
                }
                function finei(e) {
                    let input = document.getElementById('fine');
                    input.setSelectionRange(0, 4);
                }
                function cf(e, c) {
                    if (e.checked) {
                        let input = document.getElementById(c);
                        if (!f) {
                            v[c] = input.value;
                        }
                        input.value = '{{ $client->banking->fine }}';
                    } else {
                        let input = document.getElementById(c);
                        input.value = v[c];
                    }
                }
            </script>
            <x-jet-input-error for="fine" class="mt-2" />
        </div>
        <div style="display: none" class="col-span-6 sm:col-span-4">
            <x-jet-label for="interest" value="{{ __('Juros') }}" />
            @isset($billet)<x-jet-input  id="interest" min="0" name="interest" value="{{$billet->interest}}" type="number" class="mt-1 block w-full"  />
            @else<x-jet-input style="float: left" min="0" oninput="ii(this, 'interest')" value="{{ $client->banking->interest }}"
                               id="interest" name="interest" type="number" class="mt-1 block w-24"  />@endisset
            <x-jet-checkbox style="float: right" checked onclick="cf(this, 'interest')" required id="interestc" name="interestc" class="py-5 mt-1 block w-12" autocomplete="sanbox" />
            <x-jet-label class="py-4 px-2" style="float: right" for="interestc" value="{{ __('Usar Juros Default Da Conta:') }}" />
            <x-jet-input-error for="interest" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="plan_id" value="{{ __('Plano') }}" />
            <select required id="plan_id" name="plan_id" onchange="messagef(this)" class='w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                <option value="None"></option>
                @foreach($plans as $plan)
                    @isset($billet)
                        <option @if($plan->id == $billet->plan_id) selected @endif value="{{ $plan->id }}">{{ $plan->name }}</option>
                    @else
                        @isset($client->plan->id)
                            <option @if($plan->id == $client->plan->id) selected @endif value="{{ $plan->id }}">{{ $plan->name }}</option>
                        @else
                            <script>
                                document.getElementById('message_div').style.display = 'block';
                                document.getElementById('message').innerHTML = 'Cadastre um plano para o cliente primeiro.';
                            </script>
                        @endisset
                    @endisset
                @endforeach
            </select>
            <x-jet-input-error for="plan_id" class="mt-2" />
        </div>
        <div style="display: none;" class="col-span-6 sm:col-span-4">
            <x-jet-label for="plan_value" value="{{ __('Valor') }}" />
            <select id="plan_value" name="plan_value" onchange="planf(this)" class='w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                <option value="None"></option>
                @isset($plans)
                    @foreach($plans as $plan)
                        @isset($billet)
                            <option @if($plan->id == $billet->plan_id) selected @endif value="{{ $plan->id }}">{{ $plan->value }}</option>
                        @else
                            @isset($client->plan->id)
                                <option @if($plan->id == $client->plan->id) selected @endif value="{{ $plan->id }}">{{ $plan->value }}</option>
                            @endisset
                        @endisset
                    @endforeach
                @endisset
            </select>
            <x-jet-input-error for="plan_value" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="value" value="{{ __('Valor') }}" />
            <x-jet-input required id="value" name="value" value="" type="number" class="mt-1 block w-full" />
            <x-jet-input-error for="value" class="mt-2" />
        </div>
        <div style="display: none;" class="col-span-6 sm:col-span-4">
            <x-jet-label for="plan_discount_value" value="{{ __('Valor do Desconto') }}" />
            <select id="plan_discount_value" name="plan_discount_value" onchange="planf(this)" class='w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                <option value="None"></option>
                @isset($plans)
                    @foreach($plans as $plan)
                        @isset($billet)
                            <option @if($plan->id == $billet->plan_id) selected @endif value="{{ $plan->id }}">{{ $plan->discount_value }}</option>
                        @else
                            @isset($client->plan->id)
                                <option @if($plan->id == $client->plan->id) selected @endif value="{{ $plan->id }}">{{ $plan->discount_value }}</option>
                            @endisset
                        @endisset
                    @endforeach
                @endisset
            </select>
            <x-jet-input-error for="plan_discount_value" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="expire_at" value="{{ __('Data de Vencimento') }}" />
            @isset($billet)<x-jet-input required id="expire_at" max="9999-12-31" name="expire_at" value="{{$billet->expire_at}}" type="date" class="mt-1 block w-full"  />
            @else<x-jet-input required id="expire_at" value="" max="9999-12-31" name="expire_at" type="date" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="expire_at" class="mt-2" />
            <script>
                /* get date with input day next */
                var date = new Date();
                var day = date.getDate();
                if (day == {{$client->expire_at}}) {
                    var month = date.getMonth();
                } else {
                    var month = date.getMonth() + 1;
                }
                day = {{$client->expire_at}};
                var year = date.getFullYear();
                var nextDate = year + '-' + month + '-' + day;
                var ee = document.getElementById('expire_at');
                ee.value = nextDate;
            </script>
        </div>
        <div style="display: none" class="col-span-6 sm:col-span-4">
            <x-jet-label for="discount_type" value="{{ __('Tipo de Desconto') }}" />
            <div class="pt-3">
                <x-jet-label style="float: left" class="px-2" for="discount_type" value="{{ __('Dinheiro') }}" />
                <x-jet-input style="float: left" class="px-3" required id="discount_type" name="discount_type" value="currency" type="radio" class="mt-1 block w-12" />
                <x-jet-label style="float: left" class="px-2" for="discount_type" value="{{ __('Porcentagem') }}" />
                <x-jet-input required id="discount_type" checked  class="" name="discount_type" value="percentage" type="radio" class="mt-1 block w-12" />
            </div>
            <x-jet-input-error for="discount_type" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="discount_value" value="{{ __('Valor do Desconto') }}" />
            <x-jet-input required id="discount_value" name="discount_value" value="" type="number" class="mt-1 block w-full" />
            <x-jet-input-error for="discount_value" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="message" value="{{ __('Mensagem a colocar no boleto') }}" />
            @isset($billet)<x-jet-input required id="message" name="message" value="{{$billet->expire_at}}" type="date" class="mt-1 block w-full"  />
            @else<x-jet-input required id="message" name="message" type="text" class="mt-1 block w-full"  />@endisset
            <x-jet-input-error for="message" class="mt-2" />
        </div>
        <script>
            function planf(e) {
                var planve = document.getElementById('plan_value');
                planve.selectedIndex = e.options[e.selectedIndex].value;
                var plandv = document.getElementById('plan_discount_value');
                plandv.selectedIndex = e.options[e.selectedIndex].value;
                var planv = e.options[e.selectedIndex].text;
                var planvv = planve.options[planve.selectedIndex].text;
                planvv = parseInt(planvv);
                planvv -= parseInt(planve);
                var messagev = document.getElementById('message');
                messagev.value = planv + "(R$ " + planvv + ")";
                var dv = document.getElementById('conditional_discount_value');
                dv.value = plandv.options[plandv.selectedIndex].text
                var ve = document.getElementById('value');
                ve.value = planvv;
            }
            planf(document.getElementById('plan_id'));
        </script>
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
     <x-jet-button type="submit"><!-- wire:target="photo">-->
        {{ __('Criar Boleto') }}
    </x-jet-button>
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
