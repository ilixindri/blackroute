<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Types\BaseResponse;
use Session;

class ClienteController extends Controller
{
    private $clienteRequiredFields = [
        'name',
        'data_nascimento',
        'sexo',
        'email',
        'rg',
        'cpf',
        'phone',
        'whatsapp',
    ];

    private $enderecoRequiredFields = [
        'zip',
        'logradouro',
        'number',
        'uf',
        'complemento',
        'bairro',
        'type',
    ];

    public function index()
    {
        // return response()->json(new BaseResponse(Cliente::all()));
        $clients = Cliente::where('disabled', False)->get();
        // dd($clients);
        return view('clients.list', ["clients" => $clients]);
    }

    public function store(Request $request)
    {
        foreach ($this->clienteRequiredFields as $key) {
            if (!$request->get($key)) {
                // echo $key;
                // echo '<br>';
                // return response()->json(new BaseResponse(['field' => $key, $request->all()], false, 'Campos requeridos'));
                Session::flash('message', "Campo $key obrigatório.");
                Session::flash('alert-class', 'alert-error');
                return back()->withInput();
            }
        }
        $cliente = Cliente::create([
            'nome' => $request->get('name'),
            'data_nascimento' => $request->get('data_nascimento'),
            'sexo' => $request->get('sexo'),
            'email' => $request->get('email'),
            'rg' => $request->get('rg'),
            'cpf' => $request->get('cpf'),
            'phone' => $request->get('phone'),
            'whatsapp' => $request->get('whatsapp'),
        ]);

        foreach ($this->enderecoRequiredFields as $key) {
            if (!$request->get($key)) {
                return response()->json(new BaseResponse(['field' => $key, $request->all()], false, 'Campos requeridos'));
            }
        }

        $endereco = Endereco::create([
            'cep' => $request->get('zip'),
            'logradouro' => $request->get('logradouro'),
            'numero' => $request->get('number'),
            'complemento' => $request->get('complemento'),
            'bairro' => $request->get('bairro'),
            'UF' => $request->get('uf'),
            'cliente_id' => $cliente->id,
            'tipo' => $request->get('type'),
        ]);

        // return response()->json(new BaseResponse(['id' => $cliente->id], true, 'Cliente criado com sucesso'));
        Session::flash('message', 'Cliente Cadastrado com sucesso.');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('clients.edit', ['client' => $cliente->id]);
    }

    public function show($id)
    {
        // echo $id;
        // $cliente = Cliente::with('enderecos')->find($id);
        // if ($cliente) {
            // return response()->json(new BaseResponse($cliente));
        // }
        // return response()->json(new BaseResponse(null, false, 'Cliente nao encontrado'));
        return redirect()->route('clients.edit', ['client' => $id]);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            foreach ($this->clienteRequiredFields as $key) {
                if (!$request->get($key)) {
                    return response()->json(new BaseResponse(['field' => $key], false, 'Campos requeridos'));
                }
            }

            $cliente->update([
                'nome' => $request->get('name'),
                'data_nascimento' => $request->get('data_nascimento'),
                'sexo' => $request->get('sexo'),
                'email' => $request->get('email'),
                'rg' => $request->get('rg'),
                'cpf' => $request->get('cpf'),
                'phone' => $request->get('phone'),
                'whatsapp' => $request->get('whatsapp'),
            ]);
    
            foreach ($this->enderecoRequiredFields as $key) {
                if (!$request->get($key)) {
                    return response()->json(new BaseResponse(['field' => $key, $request->all()], false, 'Campos requeridos'));
                }
            }
            $endereco = Endereco::where('cliente_id', $cliente->id);
    
            $endereco->update([
                'cep' => $request->get('zip'),
                'logradouro' => $request->get('logradouro'),
                'numero' => $request->get('number'),
                'complemento' => $request->get('complemento'),
                'bairro' => $request->get('bairro'),
                'UF' => $request->get('uf'),
                'cliente_id' => $cliente->id,
                'tipo' => $request->get('type'),
            ]);

            // return response()->json(new BaseResponse(null, true, 'Cliente atualizado com sucesso'));
        }
        // return response()->json(new BaseResponse(null, false, 'Cliente não encontrado'));
        Session::flash('message', 'Cliente atualizado com sucesso.');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('clients.edit', ['client' => $cliente->id]);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $name = $cliente->nome;
        if ($cliente) {
            // $cliente->delete();
            $cliente->update(['disabled' => True]);
            // return response()->json(new BaseResponse(null, true, 'Cliente removido'));
        }
        // $endereco = Endereco::where('cliente_id', $cliente->id);
        // if ($endereco) {
        //     $endereco->delete();
        // }
        // return response()->json(new BaseResponse(null, false, 'Cliente nao encontrado'));
        Session::flash('message', "Cliente $name arquivado com sucesso.");
        Session::flash('alert-class', 'alert-error');
        return redirect()->route('clients.index');
    }

    public function storeAddress(Request $request, $id)
    {
        foreach ($this->enderecoRequiredFields as $key) {
            if (!$request->get($key)) {
                return response()->json(new BaseResponse(['field' => $key], false, 'Campos requeridos'));
            }
        }

        $cliente = Cliente::find($id);
        if ($cliente) {
            $endereco = $cliente->enderecos()->create(
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

            return response()->json(new BaseResponse(['id' => $endereco->id], true, 'Endereço criado com sucesso'));
        }
        return response()->json(new BaseResponse(null, false, 'Cliente nao encontrado'));
    }

    public function updateAddress(Request $request, $idUser, $idAddress)
    {
        foreach ($this->enderecoRequiredFields as $key) {
            if (!$request->get($key)) {
                return response()->json(new BaseResponse(['field' => $key], false, 'Campos requeridos'));
            }
        }

        $cliente = Cliente::find($idUser);
        if ($cliente) {
            $address = $cliente->enderecos()->find($idAddress);
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
        $cliente = Cliente::find($idUser);
        if ($cliente) {
            $address = $cliente->enderecos()->find($idAddress);
            if ($address) {
                $address->delete();
                return response()->json(new BaseResponse(null, true, 'Endereço removido'));
            }

            return response()->json(new BaseResponse(null, false, 'Endereço nao encontrado'));
        }
        return response()->json(new BaseResponse(null, false, 'Cliente nao encontrado'));
    }

    //NEW METHODS
    public function create()
    {
        return view('clients.form');
    }

    public function edit($id)
    {
        $client = Cliente::with('enderecos')->find($id);
        // $client = Cliente::find($id);
        // dd($client);
        return view('clients.form', ['client' => $client]);
    }
}