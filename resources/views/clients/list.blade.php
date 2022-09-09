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
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
                                    </th>
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
                                            {{-- <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a> --}}
                                            <a href="{{ route('clients.edit', $client['id']) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Editar') }}</a>
                                            <form class="inline-block" action="{{ route('clients.destroy', $client['id']) }}" method="POST" onsubmit="return confirm('{{ __("O cliente $client->name será excluído do sistema. Clique Ok para Deletar?") }}');">
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

    {{-- <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}"> --}}
                    {{-- <div class="space-y-6"> --}}
                        {{-- <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nome</th>
                                                    <th>A&ccedil;&atilde;o</th>
                                                </tr> --}}
                        {{-- <div class="flex items-start justify-between bg-gray-50 px-3 py-2">
                            <div class="w-64">ID</div>
                            <div class="w-64">Nome</div>
                            <div class="w-64">A&ccedil;&otilde;es</div>
                        </div>
                        @foreach($clientes as $cliente)
                            <div class="flex items-start justify-between px-3 py-2">
                                <div class="w-64">{{ $cliente['id'] }}</div>
                                <div class="w-64"><x-jet-label :value="$cliente['nome']"></x-jet-label></div>
                                <div class="w-64">
                                    <a href="{{route('clients.edit', ['client' => $cliente['id']])}}" style="float: left">Editar |&nbsp;</a>
                                    <form style="float: left" action="{{route('clients.destroy', ['client' => $cliente['id']])}}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit">Deletar</button> --}}
                                        {{-- <i class="fa-regular fa-trash"></i> --}}
                                    {{-- </form>
                                </div>
                            </div>
                        @endforeach --}}
                    {{-- </div> --}}
                {{-- </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>