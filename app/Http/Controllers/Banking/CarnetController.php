<?php

namespace App\Http\Controllers\Banking;

use App\Models\BankingCarnet;
use App\Models\Client;
use Illuminate\Http\Request;
use Session;

class CarnetController extends \App\Http\Controllers\Controller
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
            (new GerenciaNetController())->destroy($bankingCarnet);
        }

    }
}
