<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Models\Client;

class Controller extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $client = Client::all()->first();
//        dd($client);
        $tests = [];
        $test = (object) [];
        $test->id = 1;
        $test->functionality = 'Carnê com cliente selecionado';
        $test->action = 'Criar';
        $test->version = 'v1';
        $test->comments = '';
        $test->route = route('tests.clients.carnets.create', ['test' => 1, 'client' => $client->id]);
        $tests[] = $test;
        $test = (object) [];
        $test->id = 2;
        $test->functionality = 'Teste dos novos de campos de datas';
        $test->action = 'Testar';
        $test->version = 'v1';
        $test->comments = 'teste completo, arquivar';
        $test->route = route('tests.laravel', ['test' => 2, 'client' => $client->id]);
        $tests[] = $test;
        $test = (object) [];
        $test->id = 3;
        $test->functionality = 'Teste get route current';
        $test->action = 'Testar';
        $test->version = 'v1';
        $test->comments = '';
        $test->route = route('tests.laravel', ['test' => 3, 'client' => $client->id]);
        $tests[] = $test;
        return view('tests.list')->with('tests', $tests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
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
    public function destroy(Request $request, $id)
    {
        //
    }

    public function laravel() {
//        $client = Client::find(1);
//        $client->seen_at = '2022-09-19 19:07:22';
//        $client->save();
//        $client = Client::find(1);
//        echo $client->seen_at;

        dd(Route::currentRouteName());
    }
}
