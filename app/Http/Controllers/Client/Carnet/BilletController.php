<?php

namespace App\Http\Controllers\Client\Carnet;

use App\Models\BankingBillet;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Carnet;

class BilletController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Client $client, Carnet $carnet)
    {
        $bankingBillets = BankingBillet::where('carnet_id', $carnet->id)->get();
        $bankingBillets->carnet = $carnet;
        $bankingBillets->client = $client;
        return view('clients.carnets.billets.list')->with("bankingBillets", $bankingBillets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\BankingBillet  $bankingBillet
     * @return \Illuminate\Http\Response
     */
    public function show(BankingBillet $bankingBillet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankingBillet  $bankingBillet
     * @return \Illuminate\Http\Response
     */
    public function edit(BankingBillet $bankingBillet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankingBillet  $bankingBillet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankingBillet $bankingBillet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankingBillet  $bankingBillet
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankingBillet $bankingBillet)
    {
        //
    }
}
