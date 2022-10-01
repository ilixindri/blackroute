@php Log::debug('line 1 of elements select.blade.php') @endphp
@php
    if(isset($key2)) $aux = $key2; else $aux = '0';
    $idv = $field .  $aux; @endphp
<div id="{{'div' . $idv}}" class="col-span-6 sm:col-span-4">
    @php try { $onchange = $Model2->{$field.'__datas'}['onchange']; } catch (exception $e) { $onchange = ''; } @endphp
    <x-jet-label id="{{'label' . $idv}}" for="{{ $field }}" value="{{ __($Model2->{$field.'__datas'}['label']) }}"/>
    <select required id="{{ $field }}" name="{{ $field }}" onchange="{{ $onchange }}" style="@isset($field__datas['multiple']) width: 74%; @endisset"
            class='@isset($field__datas['multiple'])  @else w-full @endisset border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
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
                            {{--                                        @php Log::debug($object); @endphp--}}
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
                            @break
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
                                @isset($field__datas['multiple'])
                                    @isset($object)
                                        @php Log::debug('before attr select') @endphp
                                        @php $aux = $select @endphp
                                        @php Log::debug('after attr select') @endphp
                                        @isset($field__datas['options']['value'])
                                            @foreach($field__datas['options']['value'] as $option_value)
                                                @php $aux = $aux->$option_value; @endphp
                                            @endforeach
                                        @endisset
                                    @else
                                        @php $aux = $line @endphp
                                    @endisset
                                @endisset

                                @php $text = ''; @endphp
                                @foreach($Model2->{$field.'__datas'}['options']['text'] as $key3 => $field2)
                                    @if($key3 == 0)
                                        @php $text .= $line->$field2; @endphp
                                    @else
                                        @php $text .= ' - ' . $line->$field2; @endphp
                                    @endif
                                @endforeach
                                @isset($field__datas['multiple'])
                                    <option @isset($object) @if($line->id == $aux->id) selected
                                        @endif @endisset value="{{ $line->id }}">{{ $text }}</option>
                                @else
                                    <option @isset($object) @if($line->id == $object->$field) selected
                                        @endif @endisset value="{{ $line->id }}">{{ $text }}</option>
                                @endisset
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
    @isset($field__datas['multiple'])
        <a onclick="exclude_selectf('{{$field}}', '{{$idv}}')" id="exclude_select{{$idv}}" style="cursor: pointer" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            <i class="fa-regular fa-square-minus fa-lg pt-2 px-1" style="cursor: pointer"
                title="Adicionar novo campo."></i>
        </a>
        @isset($object)
{{--            @if($key2 != 0)--}}
{{--            @endif--}}
            @if($selects->count() != 0)
                @if($selects->count()-1 == $key2)
                    <a onclick="selectf('{{$field}}')" id="add_select{{$idv}}" style="cursor: pointer" class="ml-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-regular fa-plus fa-lg pt-2 px-1"
                            title="Adicionar novo campo."></i>
                    </a>
                @endif
            @else
                <a onclick="selectf('{{$field}}')" id="add_select{{$idv}}" style="cursor: pointer" class="ml-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa-regular fa-plus fa-lg pt-2 px-1"
                       title="Adicionar novo campo."></i>
                </a>
            @endif
        @else
            <a onclick="selectf('{{$field}}')" id="add_select{{$field}}0" class="ml-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" style="cursor: pointer">
                <i class="fa-regular fa-plus fa-lg pt-2 px-1"
                   title="Adicionar novo campo."></i>
            </a>
       @endisset
    @endisset
    <x-jet-input-error for="{{ $field }}" class="mt-2"/>
</div>
