<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Plano') }}
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
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Dados do Carnê') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Digite os dados do carnê.') }}
                            </p>
                        </div>
                        {{-- <div id="title2" class="py-2 px-2" onclick="section2()" style=""
                                onMouseOver="document.body.style.cursor = 'pointer';"
                                onMouseOut="document.body.style.cursor = '';">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Endereço') }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Digite o endereço do cliente.') }}
                            </p>
                        </div> --}}
                    </div>
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
                <form id="form" action=" @isset($plan) {{route('plans.update',['plan'=>$plan->id])}}@else {{ route('plans.store') }} @endisset " method="POST"
                      class="mt-5 md:mt-0 md:col-span-2">
                    @isset($plan)@method('PUT')@endisset
                    @csrf
                    <div id="form1" class="mt-5 md:mt-0 md:col-span-2">
                        @include('plans.form1')
                    </div>
                </form>
            </div>

            <x-jet-section-border/>
        </div>
    </div>
</x-app-layout>
