<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerar Boleto para :client', ["client" => $client->name]) }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <div class='md:grid md:grid-cols-3 md:gap-6'>
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <div id="title1" class="py-2 px-2" onclick="section1()" style="background-color: #eee"
                             onMouseOver="document.body.style.cursor = 'pointer';"
                             onMouseOut="document.body.style.cursor = '';">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Dados do Boleto') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Digite os dados do boleto.') }}
                            </p>
                        </div>
                        <div id="title2" style="display: none" class="py-2 px-2" onclick="section2()" style=""
                                onMouseOver="document.body.style.cursor = 'pointer';"
                                onMouseOut="document.body.style.cursor = '';">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Produtos') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Digite os produtos para gerar o boleto para o cliente.') }}
                            </p>
                        </div>
                        <div id="title3" style="display: none" class="py-2 px-2" onclick="section3()" style=""
                                onMouseOver="document.body.style.cursor = 'pointer';"
                                onMouseOut="document.body.style.cursor = '';">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Descontos') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Digite os descontos para gerar o boleto para o cliente.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <script>
                    function section1() {
                        document.getElementById('form3').style.display = 'none';
                        document.getElementById('form2').style.display = 'none';
                        document.getElementById('form1').style.display = 'block';
                        document.getElementById('title1').style.backgroundColor = '#eee';
                        document.getElementById('title2').style.backgroundColor = 'transparent';
                        document.getElementById('title3').style.backgroundColor = 'transparent';
                    }
                    function section2() {
                        document.getElementById('form3').style.display = 'none';
                        document.getElementById('form2').style.display = 'block';
                        document.getElementById('form1').style.display = 'none';
                        document.getElementById('title1').style.backgroundColor = 'transparent';
                        document.getElementById('title3').style.backgroundColor = 'transparent';
                        document.getElementById('title2').style.backgroundColor = '#eee';
                    }
                    function section3() {
                        document.getElementById('form3').style.display = 'block';
                        document.getElementById('form2').style.display = 'none';
                        document.getElementById('form1').style.display = 'none';
                        document.getElementById('title1').style.backgroundColor = 'transparent';
                        document.getElementById('title2').style.backgroundColor = 'transparent';
                        document.getElementById('title3').style.backgroundColor = '#eee';
                    }
                </script>
                <form id="form" action="{{ route('clients.carnets.store', ['client' => $client->id]) }}" method="POST"
                      class="mt-5 md:mt-0 md:col-span-2">
                    @csrf
                    <div id="form1" class="mt-5 md:mt-0 md:col-span-2">
                        {{-- <input type="hidden" id="client_id" name="client_id"
                               @isset($client) value="{{ $client->id }}" @endisset> --}}
                        @include('clients.billets.form1')
                    </div>
                    <div id="form2" style="display: none" class="mt-5 md:mt-0 md:col-span-2">
                         <input type="hidden" id="client_id" name="client_id"
                               @isset($client) value="{{ $client->id }}" @endisset>
                        @include('clients.billets.products')
                    </div>
                    <div id="form3" style="display: none" class="mt-5 md:mt-0 md:col-span-2">
                        @include('clients.billets.discount')
                    </div>
                </form>
            </div>

            <x-jet-section-border/>
        </div>
    </div>
</x-app-layout>
