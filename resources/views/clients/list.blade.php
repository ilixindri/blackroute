<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('clients.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">{{ __('Novo Cliente') }}</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('ID') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Nome') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Email') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('CPF') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Editar/Deletar') }}
                                        
                                    </th>
                                    {{-- <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
                                    </th> --}}
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($clients as $client)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $client->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $client['nome'] }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $client['email'] }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $client['cpf'] }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <form class="inline-block" action="{{ route('banking-carnets.create') }}" method="GET" onsubmit="return confirm('{{ __("Será adicionado um novo carnê para o cliente $client->name. Clique Ok para Confirmar?") }}');">
                                                {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                <input style="cursor: pointer;" type="submit" class="text-purple-600 hover:text-purple-900 mb-2 mr-2" value="Criar Carnê">
                                            </form>
                                            <form class="inline-block" action="{{ route('banking-carnets.index') }}" method="GET">
                                                {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                                <input style="cursor: pointer;" type="submit" class="text-purple-600 hover:text-purple-900 mb-2 mr-2" value="Financeiro">
                                            </form>
                                            {{-- <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a> --}}
                                            <a href="{{ route('clients.edit', $client['id']) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Editar') }}</a>
                                            <form class="inline-block" action="{{ route('clients.destroy', $client['id']) }}" method="POST" onsubmit="return confirm('{{ __("O cliente $client->name será excluído do sistema. Clique Ok para Deletar?") }}');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input style="cursor: pointer;" type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
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