<?php

namespace App\Http\Controllers\Client\Carnet;

use App\Models\BankingCarnet;
use App\Models\Client;
use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Banking\GerenciaNet;

class Controller extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Client $client)
    {
        $bankingCarnets = BankingCarnet::where('client_id', $client->id)->where('disabled', False)->get();;
        return view('clients.carnets.list', ["bankingCarnets" => $bankingCarnets, 'client' => $client]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Client $client)
    {
        $Model = (new BankingCarnet());
        return view('clients.carnets.form')->with('client', $client)->with('Model', $Model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
//        dd($request);
        $request->client = $client;
        if ($client->banking->type == 'gerencianet') {
            $carnet = (new GerenciaNet\CarnetController())->create($request);
            $carnet['data']['pdf_carnet'] = $carnet['data']['pdf']['carnet'];
            $carnet['data']['pdf_cover'] = $carnet['data']['pdf']['cover'];
            $request->carnet = $carnet['data'];
            $aux = (new GerenciaNet\CarnetController())->store($request);
            $request->carnet['id'] = $aux->id;
            foreach ($request->carnet['charges'] as $key => $charge) {
                $request->charge = $charge;
                (new GerenciaNet\BilletController())->store($request);
            }
            $expire_at = $request->carnet['charges'][0]['expire_at'];
            $repeats = count($request->carnet['charges']);
        }
        $banking = $client->banking->type__datas['label'];
        $carnet_id = $carnet['data']['carnet_id'];
        Session::flash('message', "Carnê $banking $carnet_id para $client->name com primeiro vencimento em $expire_at e $repeats parcelas gerado com sucesso.");
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('clients.carnets.index', $client->id);
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
        $client = $bankingCarnet->client;
        if ($bankingCarnet->client->banking->type == 'gerencianet') {
            $return = (new GerenciaNet\CarnetController())->update($request, $bankingCarnet);
            $message = "Carnê GerenciaNet $bankingCarnet->carnet_id para $client->name cancelado com sucesso.";
        }
        Session::flash('message', $message);
        Session::flash('alert-class', 'alert-success');
        $request = new Request();
        $request->client_id = $bankingCarnet->client->id;
        return $this->index($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankingCarnet  $bankingCarnet
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankingCarnet $bankingCarnet)
    {
        $client = $bankingCarnet->client;
        if ($bankingCarnet->client->banking->type == 'gerencianet' && $bankingCarnet->status != 'finished') {
            $return = (new GerenciaNet\CarnetController())->destroy($bankingCarnet);
            $message = "Carnê GerenciaNet $bankingCarnet->carnet_id para $client->name cancelado e arquivado com sucesso.";
            $class = 'alert-success';
        } else {
            $message = "Carnê GerenciaNet $bankingCarnet->carnet_id para $client->name já estava cancelado e foi arquivado com sucesso.";
            $class = "alert-success";
        }
        $bankingCarnet->delete();
        Session::flash('message', $message);
        Session::flash('alert-class', $class);
        $request = new Request();
        $request->client_id = $bankingCarnet->client->id;
        return $this->index($request);
    }
}
