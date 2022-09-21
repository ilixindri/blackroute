<div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions1) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
    <div class="grid grid-cols-6 gap-6">
        @php $displayable = []; @endphp
        {{--        @foreach($Model->getFillable() as $field)--}}
        @foreach($form['fields'] as $field)
            @php $field__datas = $Model2->{$field.'__datas'}; @endphp
            @php try { if ($field__datas["type"] == "text" or $field__datas["type"] == 'number'
                or $field__datas["type"] == "email" or $field__datas["type"] == "date") { @endphp
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="{{ $field }}" value="{{ __($field__datas['label']) }}"/>
                @php try { $type = $field__datas["type"]; } catch (exception $e) { } @endphp
                @php try { $oninput = $field__datas["oninput"]; } catch (exception $e) { } @endphp
                @php try { $onblur = $field__datas["onblur"]; } catch (exception $e) { } @endphp
                @php try { $max = $field__datas["max"]; } catch (exception $e) { } @endphp
                @php try { $min = $field__datas["min"]; } catch (exception $e) { } @endphp
                @isset($field__datas['value']) @php $raw = $field__datas['value'] @endphp @endisset
                @php try { $raw = $field__datas['value']; } catch (exception $e) { } @endphp
                @isset($object)
                    @php $value = $object; @endphp
                    @php function foreachf($relations) {
                        if (isset($relations['raw'])) {

                        }
                        foreach($relations as $relation) {
                            if(is_array($relation)) {
                                $value = $value->{$relation['model']}[$relation['index']];
                            } elseif($relation != '') {
                                $value = $value->$relation;
                            }
                        }
                        return $value;
                    } @endphp
                    @php $value = foreachf($form["relations"]) @endphp
                    @php try { $value = foreachf($raw); } catch (exception $e) { } @endphp
                    @if(!isset($raw)) $value = $value->$field; @endif
                    <x-jet-input required id="{{ $field }}" onblur="{{$onblur}}" oninput="{{$oninput}}" name="{{ $field }}"  value="{{ $value }}"
                                 type="{{$type}}" max="{{$max}}" min="{{$min}}" class="mt-1 block w-full" autocomplete="{{ $field }}"/>
                @else
                    <x-jet-input required id="{{ $field }}" onblur="{{$onblur}}" oninput="{{$oninput}}" name="{{ $field }}" value=""
                                 type="{{$type}}" max="{{$max}}" min="{{$min}}" class="mt-1 block w-full" autocomplete="{{ $field }}"/>
                @endisset
                <x-jet-input-error for="{{ $field }}" class="mt-2"/>
            </div>
            @php } else if ($Model2->{$field.'__datas'}["type"] == "select") { @endphp
            <div class="col-span-6 sm:col-span-4">
                @php $onchange = $Model2->{$field.'__datas'}['onchange']; @endphp
                <x-jet-label for="{{ $field }}" value="{{ __($Model2->{$field.'__datas'}['label']) }}"/>
                <select required id="{{ $field }}" name="{{ $field }}" onchange="{{ $onchange }}"
                        class='w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                    <option value="None"></option>
                    @foreach($Model2->{$field.'__datas'}['options'] as $option)
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
                            @endisset
                            @break
                        @endif
                    @endforeach
                </select>
                <x-jet-input-error for="{{ $field }}" class="mt-2"/>
            </div>
            @php $displayable[] = $field; } } catch (exception $e) { echo $e->getTraceAsString(); echo $e->getMessage(); } @endphp
        @endforeach
    </div>
</div>
