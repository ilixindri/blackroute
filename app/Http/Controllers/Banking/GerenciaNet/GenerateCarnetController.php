<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;
use App\Http\Controllers;

class GenerateCarnetController extends Controller
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
    public function create(Request $request)
    {
        if ($request->client->banking->sandbox != 0) {
            $clientId = $request->client->banking->client_id_homologation;
            $clientSecret = $request->client->banking->client_secret_homologation;
        } else {
            $clientId = $request->client->banking->client_id_production;
            $clientSecret = $request->client->banking->client_secret_production;
        }
        $options = [
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'sandbox' => $request->client->banking->sandbox
        ];
        $item_1 = [
            'name' => 'Mensalidade Internet Lux',
            'amount' => 6,
            'value' => 10000,
        ];
        $items =  [
            $item_1,
        ];
        if (strlen($request->client->phone) > 9+2) {
            if (substr($request->client->phone, 0, 1) == "+") {
                $start = 3;
            } else {
                $start = 2;
            }
            $phone_number = substr($request->client->phone, $start, strlen($request->client->phone));
        } else {
            $phone_number = $request->client->phone;
        }
        $customer = [
            'name' => $request->client->name,
            'cpf' => $request->client->cpf,
            'phone_number' => $phone_number,
        ];
        $configurations = [
            "fine" => $request->client->banking->fine,
            "interest" => $request->client->banking->interest,
        ];
        // $domain = parse_url($_SERVER['HTTP_HOST']);
        // $domain = parse_url($_SERVER['SERVER_NAME']);
        // $metadata = ['notification_url' => ];
        // Outros detalhes em: https://dev.gerencianet.com.br/docs/notificacoes
        $expire_at = date('Y-m-d', strtotime(date('Y-m-d') . ' + 10 day'));
        $body = [
            'items' => $items,
            'customer' => $customer,
            'expire_at' => $expire_at,
            'repeats' => 5,
            'split_items' => false,
            // 'metadata' => $metadata,
            'configurations' => $configurations,
        ];
        try {
            $api = new Gerencianet($options);
            $carnet = $api->createCarnet([], $body);
            print_r($carnet);
        } catch (GerencianetException $e) {
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
        return $carnet;
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
