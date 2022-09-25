@if(empty($object)) @php unset($object); @endphp @endif
<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        @php $displayable = []; @endphp
        {{--        @foreach($Model->getFillable() as $field)--}}

        @php Log::debug('-3: '.json_encode($object)); @endphp
        @php Log::debug('-3: '.json_encode($form['fields'])); @endphp
        @foreach($form['fields'] as $field)
            @php Log::debug('-2: '.json_encode($object)); @endphp
            @php Log::debug('-2: '. $field); @endphp
            @php $field__datas = $Model2->{$field.'__datas'}; @endphp
            @php Log::debug('-2: '. json_encode($field__datas)); @endphp
            @php try { $type = $field__datas["type"]; } catch (exception $e) { $type = 'text'; } @endphp
            @php try { if ($field__datas["type"] == "text" or $field__datas["type"] == 'number'
                or $field__datas["type"] == "email" or $field__datas["type"] == "date") { @endphp
            @php Log::debug('-1: '.json_encode($object)); @endphp
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="{{ $field }}" value="{{ __($field__datas['label']) }}"/>
                @php try { $oninput = $field__datas["oninput"]; } catch (exception $e) { $oninput = ''; } @endphp
                @php try { $onblur = $field__datas["onblur"]; } catch (exception $e) { $onblur = ''; } @endphp
                @php try { $max = $field__datas["max"]; } catch (exception $e) { $max = '';} @endphp
                @php try { $min = $field__datas["min"]; } catch (exception $e) { $min = ''; } @endphp
                @php try { $attributes = $field__datas["attributes"]; } catch (exception $e) { $attributes = ''; } @endphp
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
                    if(isset($field__datas["onload"])) { if(is_array($field__datas["onload"])) {
//                        if(array_keys(array_slice($field__datas["onload"], 1, 1, true))[0] != 1) {
                            $onload = $field__datas["onload"][0];
                            $params_onload = [];
                                foreach(array_slice($field__datas["onload"], 1) as $key7 => $variable) {
                                    $params_onload[$key7] = $object->$variable;
                                }
//                        } else {

//                        }
                        } else {
                            $aux = $field__datas["onload"];
                            $onload = $field__datas["onload"];
                            $onload_direct = true;
                        }
                    }
                @endphp
                @php try { $raw = $field__datas['value']; } catch (exception $e) { } @endphp
                @php Log::debug('0: '.json_encode($object)); @endphp
                @isset($object)
                    @php Log::debug($object); @endphp
                    @php $params5 = []; @endphp
                    @php $value = $object; @endphp
                    @php $value = foreachf($form["relations"], $value) @endphp
                    @php $params_value = []; @endphp
                    @php try { if(array_keys(array_slice($raw, 1, 2, true))[0] == 1) { $value = foreachf($raw, $value); }
                    else { foreach(array_slice($raw, 1) as $key7 => $variable) { if(is_array($variable)) {
                        $value2 = foreachf($variable, $object); } else { $value2 = $object->$variable; }
                        $params_value[$key7] = $value2; } $value = $raw[0]; } } catch (exception $e) { } @endphp
                    @if(!isset($raw)) @php $value = $value->$field; @endphp @endif
                    {{-- esta apresentando o mesmo valor value para os que nao tem variavel depois de um que tem valor --}}
                    {{-- por isso a linha abaixo para concertar isso enquanto descobre-se o porque --}}
                    @isset($field__datas["value"]) @if($field__datas["value"] == '') @php $value = ''; @endphp @endif @endisset
                    @if(!isset($field__datas['datalist']))
                        @php Log::debug('2: '. json_encode($object)); @endphp
                        @php Log::debug('2: '. json_encode($field__datas)); @endphp
                        @php Log::debug('2: '. $field); @endphp
                        <input class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                               {{$required}} id="{{ $field }}" onblur="{{$onblur}}" oninput="{{$oninput}}" name="{{ $field }}"
                                     value="{{ __($value, $params_value) }}" type="{{$type}}" max="{{$max}}" {{$attributes}}
                                     min="{{$min}}" class="mt-1 block w-full" autocomplete="{{ $field }}"/>
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
                <x-jet-input-error for="{{ $field }}" class="mt-2"/>
            </div>
            @php } else if ($Model2->{$field.'__datas'}["type"] == "select") { @endphp
            <div class="col-span-6 sm:col-span-4">
                @php try { $onchange = $Model2->{$field.'__datas'}['onchange']; } catch (exception $e) { $onchange = ''; } @endphp
                <x-jet-label for="{{ $field }}" value="{{ __($Model2->{$field.'__datas'}['label']) }}"/>
                <select required id="{{ $field }}" name="{{ $field }}" onchange="{{ $onchange }}"
                        class='w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                    <option value="None"></option>
                    @foreach($Model2->{$field.'__datas'}['options'] as $key => $option)
                        @if(is_array($option))
                            @isset($object)
                                @php $value = $object; @endphp
                                @foreach($form["relations"] as $relation)
                                    @if(is_array($relation))
                                        @php $value = $value->{$relation['model']}[$relation['index']]; @endphp
                                    @elseif($relation != '')
                                        @php $value = $value->$relation; @endphp
                                    @endif
                                @endforeach
                                @php $value = $value->$field; @endphp
                            @endisset
                            <option  @isset($object) @if($option["value"] == $value) selected
                                @endif @endisset value="{{ $option["value"] }}">{{ $option["text"] }}</option>
                        @else
                            @isset($Model2->{$field.'__datas'}['options']['type'])
                                @if($Model2->{$field.'__datas'}['options']['type'] == 'range')
                                    @if(is_array($Model2->{$field.'__datas'}['options']['max']))
                                        @isset($object)
                                            @php $min = $Model2->{$field.'__datas'}['options']['min']; @endphp
                                            @php $model3 = $Model2->{$field.'__datas'}['options']['max']['model']; @endphp
                                            @php $id3 = $Model2->{$field.'__datas'}['options']['max']['id']; @endphp
                                            @php $field3 = $Model2->{$field.'__datas'}['options']['max']['field']; @endphp
{{--                                            <script>alert('min: {{$min}}, model3: {{$model3}}; id3: {{$id3}}; field3: {{$field3}}')</script>--}}
{{--                                            @php dd($object); @endphp--}}
                                            {{--                                            @php exit(); @endphp--}}
                                            @php $max = $model3::find($object->$id3)->first()->$field3; @endphp
                                            @for($i = $min; $i <= $max; $i++)
                                                <option  @if($i == $object->$field) selected
                                                        @endif  value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        @endisset
                                    @else
                                        @php $min = $Model2->{$field.'__datas'}['options']['min']; @endphp
                                        @php $max = $Model2->{$field.'__datas'}['options']['max']; @endphp
                                        @for($i = $min; $i <= $max; $i++)
                                            <option @isset($object) @if($i == $object->$field) selected
                                                     @endif @endisset value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    @endif
                                @endif
                            @else
                                @isset($Model2->{$field.'__datas'}['options']['model'])
                                    @foreach($Model2->{$field.'__datas'}['options']['model']::all() as $line)
                                        @if(!isset($Model2->{$field.'__datas'}['options']['text']['raw']))
                                            @php $text = ''; @endphp
                                            @foreach($Model2->{$field.'__datas'}['options']['text'] as $key3 => $field2)
                                                @if($key3 == 0)
                                                    @php $text .= $line->$field2; @endphp
                                                @else
                                                    @php $text .= ' - ' . $line->$field2; @endphp
                                                @endif
                                            @endforeach
                                            <option @isset($object) @if($line->id == $object->$field) selected
                                                    @endif @endisset value="{{ $line->id }}">{{ $text }}</option>
                                        @else
                                            @php $text = $Model2->{$field.'__datas'}['options']['text']; @endphp
                                            @php $params4 = []; @endphp
                                            @foreach($text['variables'] as $key7 => $variable)
                                                @php $params4[$key7] = $line->$variable; @endphp
                                            @endforeach
                                            <option @isset($object) @if($line->id == $object->$field) selected
                                                    @endif @endisset value="{{ $line->id }}">{{ __($text['raw'], $params4) }}</option>
                                        @endisset
                                    @endforeach
                                    @break
                                @else
                                    <option @isset($object) @if($key == $object->$field) selected
                                        @endif @endisset value="{{ $key }}">{{ __($option) }}</option>
                                @endisset
                            @endisset
                        @endif
                    @endforeach
                </select>
                <x-jet-input-error for="{{ $field }}" class="mt-2"/>
            </div>
            @php $displayable[] = $field; } } catch (exception $e) { echo $e->getTraceAsString(); echo $e->getMessage(); } @endphp
        @endforeach
    </div>
</div>
