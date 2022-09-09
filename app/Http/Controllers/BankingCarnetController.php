<?php

namespace App\Http\Controllers;

use App\Models\BankingCarnet;
use Illuminate\Http\Request;

class BankingCarnetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bankingCarnets = BankingCarnet::all();
        return view('bankings.carnets.list', ["bankingCarnets" => $bankingCarnets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
