<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($Model->list['title']) }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                @foreach($Model->list['buttons']['top'] as $action => $button)
                    @php $params_route = []; @endphp
{{--                    @isset($button['fields'])--}}
{{--                        @foreach($button['fields'] as $key => $value)--}}
{{--                            @if(is_array($value))--}}
{{--                                @if($value[0] == 'object')--}}
{{--                                    @php $aux = $object; array_shift($value); @endphp--}}
{{--                                    @foreach($value as $_ => $field0)--}}
{{--                                        @php $aux = $aux->$field0; @endphp--}}
{{--                                    @endforeach--}}
{{--                                    @php $params_route[$key] = $aux; @endphp--}}
{{--                                @else--}}

{{--                                @endif--}}
{{--                            @else--}}

{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    @endisset--}}
                    @php $route3 = $route . '.' . $button['route']; @endphp
{{--                    @php dd($route) @endphp--}}
                    @if(substr_count($route3, '.') > 1)
                        @php $params_route['id'] = $object->id @endphp
                    @endif
                    <a id="{{$action}}" href="{{ route($route3, $params_route) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">{{ __($button['text']) }}</a>
                @endforeach
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    @foreach($Model->list['fields'] as $key => $field5)
                                        <th scope="col" {{--width="50"--}} class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __($Model->{$field5.'__datas'}['label']) }}
                                        </th>
                                    @endforeach
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($objects as $key4 => $object)
                                    <tr>
                                        @foreach($Model->list['fields'] as $key3 => $field5)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $object->$field5 }}
                                            </td>
                                        @endforeach
                                        <td class="px-6 py-2 whitespace-nowrap text-sm font-medium">
                                            @foreach($Model->list['buttons']['inline'] as $action => $button)
                                                @php $params_route = []; @endphp
{{--                                                @foreach($button['fields'] as $key => $value)--}}
{{--                                                    @php $params_route[$key] = $object->$value; @endphp--}}
{{--                                                @endforeach--}}
                                                {{-- @php dd($route) @endphp --}}
                                                @php $route3 = $route . '.' . $button['route']; @endphp
                                                @php $route2 = explode('.', $route); @endphp
                                                @if(substr_count($route3, '.') > 1 || in_array($button['route'], ['show', 'edit', 'update', 'destroy']))
                                                    @php $params_route[substr(end($route2), 0, -1)] = $object->id @endphp
                                                @endif
                                                @if($button['method'] == 'DELETE')
                                                    @php $method = 'POST' @endphp
                                                @elseif($button['method'] == 'PUT')
                                                    @php $method = 'POST' @endphp
                                                @elseif($button['method'] == 'PATCH')
                                                    @php $method = 'POST' @endphp
                                                @else
                                                    @php $method = $button['method'] @endphp
                                                @endif
                                                @foreach(array_slice($button['id'], 1) as $key6 => $param3)
                                                    @if(is_array($param3))
                                                        @php $value = $object; @endphp
                                                        @foreach($param3 as $key7 => $variable)
                                                            @php $value = $value->$variable; @endphp
                                                        @endforeach
                                                    @else
                                                        @php $value = $$param3; @endphp
                                                    @endif
                                                    @php $button['id'][0] = str_replace(":$key6", $value, $button['id'][0]); @endphp
                                                @endforeach
                                                @php $id_form = $button['id'][0] @endphp
                                                @foreach(array_slice($button['onclick'], 1) as $key6 => $param3)
                                                    @if(is_array($param3))
                                                        @php $value = $object; @endphp
                                                        @foreach($param3 as $key7 => $variable)
                                                            @php $value = $value->$variable; @endphp
                                                        @endforeach
                                                    @else
                                                        @php $value = $$param3; @endphp
                                                    @endif
                                                    @php $button['onclick'][0] = str_replace(":$key6", $value, $button['onclick'][0]); @endphp
                                                @endforeach
                                                @php $function_onclick_with_args = $button['onclick'][0]; @endphp
                                                <form id="{{$id_form}}" class="inline-block" action="{{ route($route3, $params_route) }}"
                                                      method="{{$method}}" onsubmit="">
                                                    @if($button['method'] == 'DELETE')
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    @elseif($button['method'] == 'PUT')
                                                        @method('PUT')
                                                    @elseif($button['method'] == 'PATCH')
                                                        @method('PUT')
                                                    @endif
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input style="cursor: pointer; display: none" type="submit" value="" class="text-red-600 hover:text-red-900 mb-2 mr-2">
                                                    <i class="{{$button['icon']}} fa-lg pt-2 px-1" style="cursor: pointer"
                                                       onclick="@php echo $function_onclick_with_args; @endphp" title="{{__($button['text'])}}"></i>
                                                </form>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
