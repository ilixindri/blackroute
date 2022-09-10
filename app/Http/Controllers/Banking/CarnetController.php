<?php

namespace App\Http\Controllers;

use App\Models\BankingCarnet;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Session;

class CarnetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bankingCarnets = BankingCarnet::where('client_id', $request->client_id)->get();
        return view('bankings.carnets.list', ["bankingCarnets" => $bankingCarnets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = Client::find($request->client_id)->first();
        $request->client = $client;
        if ($client->banking->type == 'gerencianet') {
            $carnet = (new GerenciaNet\GenerateCarnetController())->create($request);
        }
        $carnet['data']['pdf_carnet'] = $carnet['data']['pdf']['carnet'];
        $carnet['data']['pdf_cover'] = $carnet['data']['pdf']['cover'];
        $request->carnet = $carnet['data'];
        $aux = $this->store($request);
        $request->carnet['id'] = $aux->id;
        foreach ($request->carnet['charges'] as $key => $charge) {
            $request->charge = $charge;
            (new GerenciaNet\SaveBilletController())->store($request);
        }
        $expire_at = $request->carnet['charges'][0]['expire_at'];
        $repeats = count($request->carnet['charges']);
        Session::flash('message', "Carnê para $client->name com primeiro vencimento em $expire_at e $repeats parcelas gerado com sucesso.");
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('banking-carnets.index', $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->carnet['client_id'] = $request->client_id;
        $carnet = BankingCarnet::create($request->carnet);
        return $carnet;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankingCarnet  $bankingCarnet
     * @return \Illuminate\Http\Response
     */
    public function show(BankingCarnet $bankingCarnet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankingCarnet  $bankingCarnet
     * @return \Illuminate\Http\Response
     */
    public function edit(BankingCarnet $bankingCarnet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankingCarnet  $bankingCarnet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankingCarnet $bankingCarnet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankingCarnet  $bankingCarnet
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankingCarnet $bankingCarnet)
    {
        if ($bankingCarnet->client->banking->type == 'gerencianet') {
            (new GerenciaNetController())->create($request);
        }
        $clientId = 'informe_seu_client_id'; // insira seu Client_Id, conforme o ambiente (Des ou Prod)
        $clientSecret = 'informe_seu_client_secret'; // insira seu Client_Secret, conforme o ambiente (Des ou Prod)
        
        $options = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'sandbox' => true // altere conforme o ambiente (true = Homologação e false = producao)
        ];

        // $carnet_id refere-se ao ID do carnê desejado
        $params = [
        'id' => $carnet_id
        ];

        try {
            $api = new Gerencianet($options);
            $response = $api->cancelCarnet($params, []);
            print_r($response);
        } catch (GerencianetException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
