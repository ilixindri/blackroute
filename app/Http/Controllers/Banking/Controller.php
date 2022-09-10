<?php

namespace App\Http\Controllers;

use App\Models\Banking;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Session;

class Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankings = Banking::all();
        $Model = new Banking();
        return view('bankings.list', ['bankings' => $bankings, 'Model' => $Model]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Model = new Banking();
        return view('bankings.form', ['Model' => $Model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datas = $request->request->all();

        // $allowed = (new Banking())->getFillable();
        // $datas = array_intersect_key($datas, array_flip($allowed));
        // $banking = Banking::create($datas);

        // $banking = Banking::create([
        //     "client_id_production" => "sadf",
        //     "client_secret_production" => "sadf",
        //     "client_id_homologation" => "sadf",
        //     "client_secret_homologation" => "sadf",
        //     "fine" => "123",
        //     "interest" => "123",
        //     "sandbox" => "0",
        // ]);

        $banking = new Banking();
        $banking->name = $request->name;
        $banking->client_id_production = $request->client_id_production;
        $banking->client_secret_production = $request->client_secret_production;
        $banking->client_id_homologation = $request->client_id_homologation;
        $banking->client_secret_homologation = $request->client_secret_homologation;
        $banking->notification_url = $request->notification_url;
        $banking->fine = $request->fine;
        $banking->interest = $request->interest;
        $banking->sandbox = $request->sandbox;
        $banking->save();

        Session::flash('message', "Dados da API $banking->name cadastrado com sucesso.");
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('bankings.edit', ['banking' => $banking->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banking  $banking
     * @return \Illuminate\Http\Response
     */
    public function show(Banking $banking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banking  $banking
     * @return \Illuminate\Http\Response
     */
    public function edit(Banking $banking)
    {
        $Model = new Banking();
        // dd($banking);
        return view("bankings.form", ["banking" => $banking, "Model" => $Model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banking  $banking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banking $banking)
    {
        $datas = $request->request->all();
        $banking = Banking::find($banking)->first();
        $banking->update($datas);
        $Model = new Banking();
        Session::flash('message', "Dados da API $banking->name atualizados com sucesso.");
        Session::flash('alert-class', 'alert-success');
        return view("bankings.form", ["banking" => $banking, "Model" => $Model]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banking  $banking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banking $banking)
    {
        // $cliente->delete();
        $banking->update(['disabled' => True]);
        // return response()->json(new BaseResponse(null, true, 'Cliente removido'));
        // return response()->json(new BaseResponse(null, false, 'Cliente nao encontrado'));
        Session::flash('message', "API $banking->name arquivada com sucesso.");
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('bankings.index');
    }
}