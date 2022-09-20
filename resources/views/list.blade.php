<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($Model->list['title']) }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route($Model->list['routes']['create']['route'], []) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">{{ __($Model->list['routes']['create']['text']) }}</a>
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
                                            @foreach($Model->list['routes'] as $key => $routes2)
                                                @if($key == 'create')
                                                    @continue
                                                @endif
                                                @php $params = []; @endphp
                                                @foreach($routes2['fields'] as $key2 => $field5)
                                                    @php $params[$field5['key']] = $object->{$field5['value']}; @endphp
                                                @endforeach
                                                @if($routes2['method'] == 'DELETE')
                                                    @php $method = 'POST' @endphp
                                                @elseif($routes2['method'] == 'PUT')
                                                    @php $method = 'POST' @endphp
                                                @elseif($routes2['method'] == 'PATCH')
                                                    @php $method = 'POST' @endphp
                                                @else
                                                    @php $method = $routes2['method'] @endphp
                                                @endif
                                                <form id="{{$key}}" class="inline-block" action="{{ route($routes2['route'], $params) }}"
                                                      method="{{$method}}" onsubmit="">
                                                    @if($routes2['method'] == 'DELETE')
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    @elseif($routes2['method'] == 'PUT')
                                                        @method('PUT')
                                                    @elseif($routes2['method'] == 'PATCH')
                                                        @method('PUT')
                                                    @endif
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input style="cursor: pointer; display: none" type="submit" value="" class="text-red-600 hover:text-red-900 mb-2 mr-2">
                                                    <i class="{{$routes2['icon']}} fa-lg pt-2 px-1" style="cursor: pointer"
                                                       onclick="{{$routes2['onclick']['function']}}(
                                                           @foreach($routes2['onclick']['params'] as $key6 => $param3)
                                                                @if($param3['type'] == 'text')
                                                                    @php $params4 = []; @endphp
                                                                    @foreach($param3['value']['variables'] as $key7 => $variable)
                                                                        @php $params4[$key7] = $object->$variable; @endphp
                                                                    @endforeach
                                                                    '{{__($param3['value']['raw'], $params4)}}',
                                                                @elseif($param3['type'] == 'variable')
                                                                    '{{ $object->{$param3['variable']} }}'
                                                                @endif
                                                           @endforeach
                                                           )" title="{{__($routes2['text'])}}"></i>
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
