<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cliente') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <div class='md:grid md:grid-cols-3 md:gap-6'>
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        @foreach($Model->forms as $key => $form)
                            <div id="title{{$key}}" class="py-2 px-2" onclick="section{{$key}}()"
                                onMouseOver="document.body.style.cursor = 'pointer';"
                                onMouseOut="document.body.style.cursor = '';">
                                <h3 class="text-lg font-medium text-gray-900">{{ __($form['title']) }}</h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __($form['text']) }}
                                </p>
                            </div>
                            <script>
                                function section{{$key}}() {
                                    @foreach($Model->forms as $key2 => $form)
                                        @if($key == $key2)
                                            document.getElementById('form{{$key2}}').style.display = 'block';
                                            document.getElementById('title{{$key2}}').style.backgroundColor = '#eee';
                                        @else
                                            document.getElementById('form{{$key2}}').style.display = 'none';
                                            document.getElementById('title{{$key2}}').style.backgroundColor = 'transparent';
                                        @endif
                                    @endforeach
                                    /* add text to url */
                                    {{--window.location.href += '#{{$form['view']}}';--}}
                                    if (window.location.hash.substring(0, 1) == '#') {
                                        window.location.hash = '';
                                        window.location.href += '{{$key}}';
                                    } else {
                                        window.location.href += '#{{$key}}';
                                    }
                                }
                            </script>
                        @endforeach
                    </div>
                </div>
                <script>
                    document.getElementById('title0').style.backgroundColor = '#eee';
                </script>
                <form id="client" action="@isset($client){{ route('clients.update', ['client'=>$client->id]) }}@else{{ route('clients.store') }}@endisset" method="POST" class="mt-5 md:mt-0 md:col-span-2">
                    @csrf
                    @isset($client)@method('PUT')@endisset
                    @foreach($Model->forms as $key => $form)
                        <div id="form{{$key}}" style="display: none" class="mt-5 md:mt-0 md:col-span-2">
                            @include("clients." . $form['view'])
                        </div>
                    @endforeach
                    <script>
                        document.getElementById('form0').style.display = 'block';
                    </script>
                </form>
                <script>
                    window['section' + window.location.hash.substring(1)]();
                </script>
            </div>

            <x-jet-section-border />
        </div>
    </div>
</x-app-layout>
