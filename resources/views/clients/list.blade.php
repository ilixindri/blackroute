<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
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
                        <div class="flex items-start justify-between bg-gray-50 px-3 py-2">
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
                                        <button type="submit">Deletar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>