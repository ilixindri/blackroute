<?php

namespace App\Http\Controllers\Banking\GerenciaNet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BilletController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->charge['pdf_charge'] = $request->charge['pdf']['charge'];
        $request->charge['pix_qrcode'] = $request->charge['pix']['qrcode'];
        $request->charge['pix_qrcode_image'] = $request->charge['pix']['qrcode_image'];
        $request->charge['client_id'] = $request->client_id;
        $request->charge['fine'] = strval($request->client->banking->fine);
        $request->charge['interest'] = strval($request->client->banking->interest);
        try {
            $request->charge['carnet_id'] = $request->carnet['id'];
        } catch (\Throwable $th) { }
        try {
            $billet = BankingBillet::create($request->charge);
        } catch (\Throwable $th) {
        }
        return $billet;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}