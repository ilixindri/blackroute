<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- @php
                dd((array) $bankingCarnets);
            @endphp --}}
            {{-- {{ __('Carnês') }} {{ ((array) $bankingCarnets)[0]->client->name }} --}}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            {{-- <div class="block mb-8">
                <a href="{{ route('clients.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">{{ __('Novo Cliente') }}</a>
            </div> --}}
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    {{-- <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Cliente') }}
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('ID do Carnê no GerenciaNet') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($bankingCarnets as $carnet)
                                    <tr>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $carnet->client->name }}
                                        </td> --}}

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $carnet->carnet_id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $carnet->status }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            {{-- <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a> --}}

                                            <a href="{{ $carnet->cover }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Capa') }}</a>
                                            <a href="{{ $carnet->link }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Link') }}</a>
                                            <a href="{{ $carnet->carnet_link }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Link do Carnê') }}</a>
                                            <a href="{{ $carnet->carnet_link }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Link do Carnê') }}</a>
                                            <!-- <a href="{{ $carnet->pdf_carnet }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Carnê em PDF') }}</a>
                                            <a href="{{ $carnet->pdf_cover }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Capa em PDF') }}</a> -->
                                            <form class="inline-block" action="{{ route('banking-billets.index') }}" method="POST" onsubmit="">
                                                <input type="hidden" name="carnet_id" value="{{ $carnet['id'] }}">
                                                <input type="submit" style="cursor: pointer" class="button text-brown-600 hover:text-brown-900 mb-2 mr-2" value="Ver Boletos">
                                            </form>
                                            <form class="inline-block" action="{{ route('banking-carnets.update', $carnet['id']) }}" method="POST"
                                                    onsubmit="return confirm('{{ __("O carnê :type :id do cliente :client será cancelado. Confirme para cancelar esse carnê?",
                                                        ["type" => $carnet->client->banking->type__datas['label'], 'id' => $carnet->carnet_id, "client" => $carnet->client->name]) }}');">
                                                <input type="hidden" name="_method" value="PATCH">
                                                <input type="hidden" name="action" value="cancel">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" style="cursor: pointer" class="button text-red-600 hover:text-red-900 mb-2 mr-2" value="Cancelar">
                                            </form>
                                            <form class="inline-block" action="{{ route('banking-carnets.destroy', $carnet['id']) }}" method="POST"
                                                onsubmit="return confirm('{{ __("O carnê :type :id do cliente :client será deletado. Confirme para deletar esse carnê?",
                                                        ["type" => $carnet->client->banking->type__datas['label'], 'id' => $carnet->carnet_id, "client" => $carnet->client->name]) }}');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" style="cursor: pointer" class="button text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
                                            </form>
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
