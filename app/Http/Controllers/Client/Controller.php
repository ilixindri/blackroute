<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use App\Models\Address;
use App\Models\Banking;
use App\Models\Cto;
use Illuminate\Http\Request;
use App\Types\BaseResponse;
use Session;

class Controller extends \App\Http\Controllers\Controller
{
    private $clientRequiredFields = ['name', 'birth_date', 'sexo', 'email', 'rg', 'cpf', 'phone', 'whatsapp',];

    private $addressRequiredFields = ['zip', 'logradouro', 'number', 'uf', 'complemento', 'bairro', 'type',];

    public function index(Request $request)
    {
        // return response()->json(new BaseResponse(Cliente::all()));
        $clients = Client::all();
        return view('list', ["objects" => $clients, "Model" => new Client()]);
    }

    public function create(Request $request)
    {
        return view('form')->with('Model', new Client());
    }

    public function store(Request $request)
    {
//        foreach ($this->clientRequiredFields as $key) {
//            if (!$request->get($key)) {
//                // return response()->json(new BaseResponse(['field' => $key, $request->all()], false, 'Campos requeridos'));
//                Session::flash('message', "Campo $key obrigatório.");
//                Session::flash('alert-class', 'alert-error');
//                return back()->withInput();
//            }
//        }
        $insert = $request->request->all();
        $client = Client::create($insert);
//        foreach ($this->addressRequiredFields as $key) {
//            if (!$request->get($key)) {
//                return response()->json(new BaseResponse(['field' => $key, $request->all()], false, 'Campos requeridos'));
//            }
//        }
        $insert['client_id'] = $client->id;
        $address = Address::create($insert);
        // return response()->json(new BaseResponse(['id' => $cliente->id], true, 'Cliente criado com sucesso'));
        Session::flash('message', 'Cliente cadastrado com sucesso.');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('clients.edit', ['client' => $client->id]);
    }

    public function show(Request $request, $id)
    {
        // $cliente = Cliente::with('enderecos')->find($id);
        // if ($cliente) {
            // return response()->json(new BaseResponse($cliente));
        // }
        // return response()->json(new BaseResponse(null, false, 'Cliente nao encontrado'));
        return redirect()->route('clients.edit', ['client' => $id]);
    }

    public function edit(Request $request, $id)
    {
        $client = Client::with('adresses')->find($id);
        // $client = Cliente::find($id);
        // dd($client);
        return view('form', ['object' => $client])->with('Model', new Client());
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id)->first();
        if ($client) {
//            foreach ($this->clientRequiredFields as $key) {
//                if (!$request->get($key)) {
//                    return response()->json(new BaseResponse(['field' => $key], false, 'Campos requeridos'));
//                }
//            }
            $client->update($request->request->all());

//            $client->update([
//                'name' => $request->get('name'),
//                'birth_date' => $request->get('birth_date'),
//                'sexo' => $request->get('sexo'),
//                'email' => $request->get('email'),
//                'rg' => $request->get('rg'),
//                'cpf' => $request->get('cpf'),
//                'phone' => $request->get('phone'),
//                'whatsapp' => $request->get('whatsapp'),
//            ]);

//            foreach ($this->addressRequiredFields as $key) {
//                if (!$request->get($key)) {
//                    return response()->json(new BaseResponse(['field' => $key, $request->all()], false, 'Campos requeridos'));
//                }
//            }
            $address = Address::where('client_id', $client->id)->first();
            $address->update($request->request->all());
//            $address->update([
//                'cep' => $request->get('zip'),
//                'logradouro' => $request->get('logradouro'),
//                'numero' => $request->get('number'),
//                'complemento' => $request->get('complemento'),
//                'bairro' => $request->get('bairro'),
//                'UF' => $request->get('uf'),
//                'client_id' => $client->id,
//                'tipo' => $request->get('type'),
//                'coordinates' => $request->get('coordinates'),
//            ]);

            // return response()->json(new BaseResponse(null, true, 'Cliente atualizado com sucesso'));
        }
        // return response()->json(new BaseResponse(null, false, 'Cliente não encontrado'));
        Session::flash('message', 'Cliente atualizado com sucesso.');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('clients.edit', ['client' => $client->id]);
    }

    public function destroy(Request $request, $id)
    {
        $client = Client::find($id)->first();
        $name = $client->name;
        if ($client) {
             $client->delete();
            // return response()->json(new BaseResponse(null, true, 'Cliente removido'));
        }
    // $endereco = Endereco::where('cliente_id', $cliente->id);
        // if ($endereco) {
        //     $endereco->delete();
        // }
        // return response()->json(new BaseResponse(null, false, 'Cliente nao encontrado'));
        Session::flash('message', "Cliente $name arquivado com sucesso.");
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('clients.index');
    }

    public function storeAddress(Request $request, $id)
    {
        foreach ($this->addressRequiredFields as $key) {
            if (!$request->get($key)) {
                return response()->json(new BaseResponse(['field' => $key], false, 'Campos requeridos'));
            }
        }

        $client = Client::find($id);
        if ($client) {
            $address = $client->enderecos()->create(
                [
                    'cep' => $request->get('cep'),
                    'logradouro' => $request->get('logradouro'),
                    'numero' => $request->get('numero'),
                    'UF' => $request->get('UF'),
                    'tipo' => $request->get('tipo') ?? 'Residencial',
                    'bairro' => $request->get('bairro') ?? null,
                    'complemento' => $request->get('complemento') ?? null,
                    'coordinates' => $request->get('coordinates') ?? null,
                ]
            );

            return response()->json(new BaseResponse(['id' => $endereco->id], true, 'Endereço criado com sucesso'));
        }
        return response()->json(new BaseResponse(null, false, 'Cliente nao encontrado'));
    }

    public function updateAddress(Request $request, $idUser, $idAddress)
    {
        foreach ($this->addressRequiredFields as $key) {
            if (!$request->get($key)) {
                return response()->json(new BaseResponse(['field' => $key], false, 'Campos requeridos'));
            }
        }

        $client = Client::find($idUser);
        if ($client) {
            $address = $client->adresses()->find($idAddress);
            if ($address) {
                $address->update(
                    [
                        'cep' => $request->get('cep'),
                        'logradouro' => $request->get('logradouro'),
                        'numero' => $request->get('numero'),
                        'UF' => $request->get('UF'),
                        'tipo' => $request->get('tipo') ?? 'Residencial',
                        'bairro' => $request->get('bairro') ?? null,
                        'complemento' => $request->get('complemento') ?? null,
                    ]
                );
                return response()->json(new BaseResponse(null, true, 'Endereço atualizado'));
            }

            return response()->json(new BaseResponse(null, false, 'Endereço nao encontrado'));
        }
        return response()->json(new BaseResponse(null, false, 'Cliente nao encontrado'));
    }

    public function destroyAddress($idUser, $idAddress)
    {
        $client = Client::find($idUser);
        if ($cliente) {
            $address = $cliente->adresses()->find($idAddress);
            if ($address) {
                $address->delete();
                return response()->json(new BaseResponse(null, true, 'Endereço removido'));
            }

            return response()->json(new BaseResponse(null, false, 'Endereço nao encontrado'));
        }
        return response()->json(new BaseResponse(null, false, 'Cliente nao encontrado'));
    }
}
