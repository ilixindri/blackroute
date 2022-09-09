<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carnês') }}
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
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Cliente') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($bankingCarnets as $carnet)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $carnet->client->nome }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $carnet->status }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            {{-- <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a> --}}

                                            <a href="{{ $carnet->cover }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Capa') }}</a>
                                            <a href="{{ $carnet->link }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Link') }}</a>
                                            <a href="{{ $carnet->carnet_link }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Link do Carnê') }}</a>
                                            <a href="{{ $carnet->pdf_carnet }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Carnê em PDF') }}</a>
                                            <a href="{{ $carnet->pdf_cover }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Capa em PDF') }}</a>
                                            <form class="inline-block" action="{{ route('clients.destroy', $client['id']) }}" method="POST" onsubmit="return confirm('{{ __("O carnê do cliente $carnet->client->nome será dado baixa e arquivado. Clique Ok para Deletar?") }}');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
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