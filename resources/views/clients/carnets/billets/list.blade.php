<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Boletos do Carnê :type :id do Cliente :client', 
                ['type' => $bankingBillets->client->banking->type__datas['label'], 'id' => $bankingBillets->carnet->carnet_id, 
                'client' => $bankingBillets->client->name]) }}
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
                                        {{ __('ID GerenciaNet do Boleto') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Parcela') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Valor') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Vencimento') }}
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
{{-- @php --}}
    {{-- dd($bankingBillets); --}}
{{-- @endphp --}}
                                @foreach ($bankingBillets as $billet)
                                    <tr>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $carnet->client->name }}
                                        </td> --}}
{{-- @php --}}
    {{-- dd($billet); --}}
{{-- @endphp --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $billet->charge_id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $billet->parcel }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $billet->status }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $billet->value }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $billet->expire_at }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            {{-- <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">View</a> --}}
                                            <button onclick="pix('{{ $billet->pix_qrcode }}')" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Copiar PIX Copia e Cola') }}</button>
                                            {{-- <button onclick="pix{{ $billet->id }}()" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Copiar PIX Copia e Cola') }}</button> --}}
                                            {{-- <button id="pixb{{ $billet->id }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Copiar PIX Copia e Cola') }}</button> --}}
                                            <input type="hidden" id="pix{{ $billet->id }}" value="{{ $billet->pix_qrcode }}">
                                            <script>
                                                // 
                                                function pix(text) {
                                                    navigator.permissions.query({name: "clipboard-write"}).then(result => {
                                                        if (result.state == "granted" || result.state == "prompt") {
                                                            // write to the clipboard now
                                                            // console.log('ok')
                                                        }
                                                    });
                                                    var textArea = document.createElement("textarea");
                                                    textArea.style.position = 'fixed';
                                                    textArea.style.top = 0;
                                                    textArea.style.left = 0;
                                                    textArea.style.width = '2em';
                                                    textArea.style.height = '2em';
                                                    textArea.style.padding = 0;
                                                    textArea.style.border = 'none';
                                                    textArea.style.outline = 'none';
                                                    textArea.style.boxShadow = 'none';
                                                    textArea.style.background = 'transparent';
                                                    textArea.value = text;
                                                    document.body.appendChild(textArea);
                                                    textArea.select();
                                                    try {
                                                        var successful = document.execCommand('copy');
                                                        var msg = successful ? 'successful' : 'unsuccessful';
                                                        console.log('Copying text command was ' + msg);
                                                    } catch (err) {
                                                        console.log('Oops, unable to copy');
                                                    }
                                                    document.body.removeChild(textArea);
                                                }
                                                function pix{{ $billet->id }}() {
                                                    var copyGfGText = document.getElementById("pix{{ $billet->id }}");
                                                    copyGfGText.select();
                                                    try {
                                                        document.execCommand("copy");
                                                    } catch (ex) {
                                                        console.warn("Copy to clipboard failed.", ex);
                                                    } finally {
                                                    }

                                                    // const clipboardItem = new ClipboardItem({
                                                    //     'text/plain': someAsyncMethod().then((result) => {
                                                    //     /**
                                                    //      * We have to return an empty string to the clipboard if something bad happens, otherwise the
                                                    //      * return type for the ClipBoardItem is incorrect.
                                                    //      */
                                                    //     if (!result) {
                                                    //         return new Promise(async (resolve) => {
                                                    //             resolve(new Blob[``]())
                                                    //         })
                                                    //     }
                                                    //     var copyGfGText = document.getElementById("pix{{ $billet->id }}");
                                                    //     const copyText = copyGfGText.value;
                                                    //         return new Promise(async (resolve) => {
                                                    //             resolve(new Blob([copyText]))
                                                    //             console.log('ok')
                                                    //         })
                                                    //     }),
                                                    // })
                                                    // // Now, we can write to the clipboard in Safari
                                                    // navigator.clipboard.write([clipboardItem])

                                                    document.getElementById('message').innerHTML = "{{ __('PIX Copia e Cola do boleto :banking :id copiado com sucesso.',
                                                        ['banking' => $billet->client->banking->type__datas['label'], 'id' => $billet->charge_id]) }}";
                                                    document.getElementById('message_div').style.display = 'block';
                                                }
                                                let copyToClipboardButton{{ $billet->id }} = document.getElementById('pixb{{ $billet->id }}');
                                                copyToClipboardButton{{ $billet->id }}.addEventListener('click', () => {
                                                    console.log(navigator.permissions.query({ nome: 'clipboard-read' }));
                                                    console.log(document.queryCommandSupported);
                                                    console.log(document.queryCommandSupported("copy"));
                                                    let textToCopy = document.getElementById('pix{{ $billet->id }}').innerText;
                                                    if(navigator.clipboard) {
                                                        navigator.clipboard.writeText(textToCopy).then(() => {
                                                            document.getElementById('message').innerHTML = "{{ __('PIX Copia e Cola do boleto :banking :id copiado com sucesso.',
                                                                ['banking' => $billet->client->banking->type__datas['label'], 'id' => $billet->charge_id]) }}";
                                                            document.getElementById('message_div').style.display = 'block';
                                                        })
                                                    } else {
                                                        console.log('Browser Not compatible with writeText to clipboard');
                                                    }
                                                })
                                            </script>
                                            <a href="{{ $billet->url }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Link') }}</a>
                                            <a href="{{ $billet->parcel_link }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Link do Boleto') }}</a>
                                            <a href="{{ $billet->pdf_charge }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2"> {{ __('Boleto em PDF') }}</a>
                                            <form class="inline-block" action="{{ route('clients.carnets.billets.destroy', 
                                                    ['client' => $bankingBillets->client->id, 'carnet' => $bankingBillets->carnet->id, 'billet' => $billet->id]) }}"
                                                    method="POST" onsubmit="return confirm('{{ __("O boleto com vencimento em $billet->expire_at do cliente $billet->client->name será dado baixa e deletado. Clique Ok para Deletar?") }}');">
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
