@php Log::debug('line 1 of elements input_element.blade.php') @endphp
<div class="col-span-6 sm:col-span-4">

    @php try { $label = $field__datas["label"]; } catch (exception $e) { $label = $field__datas[1]; } @endphp
    <label for="{{ $field }}" class="block font-medium text-sm text-gray-700">@php echo __($label); @endphp</label>
    @php try { $oninput = $field__datas["oninput"]; } catch (exception $e) { $oninput = ''; } @endphp
    @php try { $onblur = $field__datas["onblur"]; } catch (exception $e) { $onblur = ''; } @endphp
    @php try { $max = $field__datas["max"]; } catch (exception $e) { $max = '';} @endphp
    @php try { $min = $field__datas["min"]; } catch (exception $e) { $min = ''; } @endphp
    @php try { $attributes = $field__datas["attributes"]; } catch (exception $e) { $attributes = ''; } @endphp
    @php Log::debug('line 9') @endphp


    @isset($field__datas["required"])
        @if($field__datas["required"])
            @php $required = 'required' @endphp
        @else
            @php $required = '' @endphp
        @endif
    @else
        @php $required = 'required' @endphp
    @endisset
    @php $onload = ''; @endphp
    @php $params_onload = [];
    if(isset($field__datas["onload"])) {
        if(is_array($field__datas["onload"])) {
            $onload = $field__datas["onload"][0];
            $params_onload = [];
            foreach(array_slice($field__datas["onload"], 1) as $key7 => $variable) {
                $params_onload[$key7] = $object->$variable;
            }
        } else {
            $aux = $field__datas["onload"];
            $onload = $field__datas["onload"];
            $onload_direct = true;
        }
    }
    @endphp
    @php try { $raw = $field__datas['value']; } catch (exception $e) { } @endphp
    {{--                @php Log::debug('0: '.json_encode($object)); @endphp--}}
    @isset($object)
        @php $params5 = []; @endphp
        @php $value = $object; @endphp

        {{--
        erro
        @php $value = foreachf($form["relations"], $value) @endphp
        --}}
        @php $params_value = []; @endphp
        @php
            try {
                if(array_keys(array_slice($raw, 1, 2, true))[0] == 1) { $value = foreachf($raw, $value); }
                else {
                    foreach(array_slice($raw, 1) as $key7 => $variable) {
                        if(is_array($variable)) { $value2 = foreachf($variable, $object); }
                        else { $value2 = $object->$variable; }
                        $params_value[$key7] = $value2;
                    }
                    $value = $raw[0];
                }
            } catch (exception $e) { }
        @endphp
        {{--                    @php Log::debug($object); @endphp--}}
        {{--

        @if(!isset($raw)) @php $value = $value->$field; @endphp @endif
        @php Log::debug('line 50') @endphp
        {{-- esta apresentando o mesmo valor value para os que nao tem variavel depois de um que tem valor --}}
        {{-- por isso a linha abaixo para concertar isso enquanto descobre-se o porque --}}
        @isset($field__datas["value"]) @if($field__datas["value"] == '') @php $value = ''; @endphp @endif @endisset
        @if(!isset($field__datas['datalist']))
            {{--                        @php Log::debug('2: '. json_encode($object)); @endphp--}}
            {{--                        @php Log::debug('2: '. json_encode($field__datas)); @endphp--}}
            {{--                        @php Log::debug('2: '. $field); @endphp--}}

            {{--
            <input class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                   {{ $required }} id="{{ $field }}" onblur="{{ $onblur }}" oninput="{{ $oninput }}" name="{{ $field }}"
                   value="{{ __($value, $params_value) }}" type="{{ $type }}" max="{{ $max }}" {{ $attributes }}
                   min="{{ $min }}" class="mt-1 block w-full" autocomplete="{{ $field }}"/>
            --}}


        {{-- --------------------------PRIMEIRO FOI A VARIAVEL ATRIBUTES---------------------------------- --}}
            {{-- --------------------------AGORA FOI A VARIAVEL MIN---------------------------------- --}}
            <input class="w-full300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    id="" onblur="" oninput="" name=""
                   value="" type="" max=""
                   min="" class="mt-1 block w-full" autocomplete="{{ $field }}"/>



            @isset($field__datas["onload"])
                <script>
                    /* run code after document loaded */
                    document.addEventListener('DOMContentLoaded', function() {
                        @isset($onload_direct)
                            @if($onload_direct == true)
                               @php echo $onload; @endphp
                                @php $onload_direct = false; @endphp
                            @else
                                {{__($onload, $params_onload)}};
                            @endif
                        @else
                                {{__($onload, $params_onload)}};
                        @endisset
                    });
                </script>
            @endisset
        @else
            <x-jet-input required id="{{ $field }}" min="{{$min}}" name="{{ $field }}" list="{{ $field }}d" value="" type="search" class="mt-1 block w-full"  />
            <datalist id="{{ $field }}d" class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1  w-full">
            </datalist>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var d = document.getElementById('{{ $field }}d');
                    d.style.width = '100%';
                    d.style.height = '100%';
                    for (let i = {{$field__datas['datalist'][0]}}; i != {{$field__datas['datalist'][1]}}+1; i++) {
                        var optionv = document.createElement('option');
                        optionv.value = i;
                        d.appendChild(optionv);
                    }
                });
            </script>
        @endif
    @else
        <x-jet-input required id="{{ $field }}" onblur="{{$onblur}}" oninput="{{$oninput}}" name="{{ $field }}" value=""
                     type="{{$type}}" max="{{$max}}" min="{{$min}}" class="mt-1 block w-full" autocomplete="{{ $field }}"/>
    @endisset
{{--
    <x-jet-input-error for="{{ $field }}" class="mt-2"/>
--}}
</div>
