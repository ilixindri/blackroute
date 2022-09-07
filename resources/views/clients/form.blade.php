<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cliente') }}
        </h2>
    </x-slot>

    @if(Session::has('message'))
        <div>
            <div class="alert alert-success max-w-7xl mx-auto pt-4 px-4 sm:px-6 lg:px-8">
                <div class="rounded-r-md bg-green-100 p-4 border-l-4 border-green-400 mb-3">
                    <div class="flex">
                    <div class="flex-shrink-0">
                        <p class="text-green-400">
                            <i class="fas fa-check"></i>
                        </p>
                    </div>
                    <div class="ml-3 text-sm leading-5 font-medium text-green-800">
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button type="button" class="inline-flex rounded-md p-1.5 text-green-800 focus:outline-none transition ease-in-out duration-150" wire:click="dismiss">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endif

    <div>
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <div class='md:grid md:grid-cols-3 md:gap-6'>
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <div id="title1" class="py-2 px-2" onclick="section1()" style="background-color: #eee"
                            onMouseOver="document.body.style.cursor = 'pointer';"
                            onMouseOut="document.body.style.cursor = '';">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Dados Pessoais') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Digite os dados pessoais do cliente.') }}
                            </p>
                        </div>
                    {{-- </div> --}}
                    {{-- <div class="px-4 sm:px-0">
                        {{ $aside ?? '' }}
                    </div> --}}
                {{-- </div> --}}
                {{-- <div class="md:col-span-1 flex justify-between" onclick="section2()" style="float: left!important"> --}}
                    {{-- <div class="px-4 sm:px-0"> --}}
                        <div id="title2" class="py-2 px-2" onclick="section2()" style="" 
                                onMouseOver="document.body.style.cursor = 'pointer';"
                                onMouseOut="document.body.style.cursor = '';">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Endereço') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Digite o endereço do cliente.') }}
                            </p>
                        </div>
                    </div>
                    {{-- <div class="px-4 sm:px-0">
                        {{ $aside ?? '' }}
                    </div> --}}
                </div>
                <script>
                    function section1() {
                        document.getElementById('form2').style.display = 'none';
                        document.getElementById('form1').style.display = 'block';
                        document.getElementById('title1').style.backgroundColor = '#eee';
                        document.getElementById('title2').style.backgroundColor = 'transparent';
                    }
                    function section2() {
                        document.getElementById('form2').style.display = 'block';
                        document.getElementById('form1').style.display = 'none';
                        document.getElementById('title1').style.backgroundColor = 'transparent';
                        document.getElementById('title2').style.backgroundColor = '#eee';
                    }
                </script>
                <form id="client" action="@isset($client){{ route('clients.update', ['client'=>$client->id]) }}@else{{ route('clients.store') }}@endisset" method="POST" class="mt-5 md:mt-0 md:col-span-2">
                    @csrf
                    @isset($client)@method('PUT')@endisset
                    <div id="form1" class="mt-5 md:mt-0 md:col-span-2">
                        @include('clients.personal-data')
                    </div>
                    <div id="form2" class="mt-5 md:mt-0 md:col-span-2" style="display: none">
                        @include('clients.address')
                    </div>
                </form>
            </div>

            <x-jet-section-border />
        </div>
    </div>
</x-app-layout>