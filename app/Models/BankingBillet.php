<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankingBillet extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'carnet_id', 'banking_id', 'charge_id', 'parcel', 'status',
        'value', 'expire_at', 'url', 'parcel_link', 'pdf_charge', 'barcode',
        'pix_qrcode', 'pix_qrcode_image', 'fine', 'interest', 'sandbox'];

    public $list = ['fields' => ['id', 'name', 'email', 'cpf'], 'title' => 'Clientes',
        'routes' => [
            'create' => ['route' => 'clients.create', 'fields' => [['key' => '', 'value' => ''],], 'text' => 'Novo Cliente', 'icon' => ''],
            'financial' => ['route' => 'clients.carnets.index', 'fields' => [['key' => 'client', 'value' => 'id'],],
                'text' => 'Financeiro', 'icon' => 'fa-regular fa-dollar-sign',
                'method' => 'GET', 'onclick' => ['function' => 'formf', 'params' => [['type' => 'text', 'value' => ['raw' => 'financial:id', 'variables' => ['id' => 'id']]]]]],
            'edit' => ['route' => 'clients.edit', 'fields' => [['key' => 'client', 'value' => 'id'],], 'text' => 'Editar',
                'icon' => 'fa-regular fa-pen-to-square', 'method' => 'GET',
                'onclick' => ['function' => 'formf', 'params' => [['type' => 'text', 'value' => ['raw' => 'edit:id', 'variables' => ['id' => 'id']]]]]],
            'delete' => ['route' => 'clients.destroy', 'fields' => [['key' => 'client', 'value' => 'id'],],
                'text' => 'Deletar', 'icon' => 'fa-regular fa-trash-can', 'method' => 'DELETE', 'onclick' => ['function' => 'formfc',
                    'params' => [
                        ['type' => 'text', 'value' => ['raw' => 'delete:id', 'variables' => ['id' => 'id']]],
                        ['type' => 'text',//text/variable -> variable: ['type'=>'variable', 'value' => 'name']
                        'value' => ['raw' => 'O cliente :client será excluído do sistema. Clique Ok para Deletar?', 'variables' => ['client' => 'name']]]]]],
        ]
    ];
    public $forms = ['Boleto', 'routes' => [['clients.billets.store', 'client' => 'id'], ['clients.billets.update']],
        ['title' => 'Dados do Boleto', 'text' => 'Digite os dados do boleto.',
            'fields' => ['quantity', 'plan_name', 'value', 'expire_at', 'discount_value', 'msg'],
            'model' => '\App\Models\BankingBillet', 'relations' => []],
        ];
    const tests = [
        ['quantity' => 3, 'plan_name' => 'None', 'value' => 'None', 'expire_at' => 'None', 'discount_value' => '10,00', 'msg' => 'None'],
    ];

    public $quantity__datas = ['type' => 'number', 'label' => 'Quantidade', 'oninput' => '', 'onblur' => '',
        'onchange' => '', 'min' => '1', 'max' => '', 'attributes' => '', 'datalist' => [1, 24]];
    public $plan_name__datas = ['type' => 'text', 'label' => 'Plano', 'oninput' => '', 'onblur' => '', 'onchange' => '',
        'min' => '', 'max' => '', 'attributes' => 'disabled', 'value' => ['plan', 'name']];
    //'value' => ['raw' => ':name :plan', 'name' => 'name', 'plan' => ['plan', 'name']]
    public $value__datas = ['type' => 'text', 'label' => 'Valor', 'oninput' => 'valuef(this)', 'onblur' => '', 'onchange' => '',
        'onload' => "value_onload('value')",
        'max' => '', 'min' => '', 'attributes' => '', 'value' => ['R$ :value', 'value' => ['plan', 'value']]];
    public $expire_at__datas = ['type' => 'date', 'label' => 'Data de Vencimento', 'oninput' => '', 'onblur' => '',
        'onchange' => '', 'onload' => ['expire_atf(:expire_at)', "expire_at" => "expire_at"], 'min' => '', 'max' => '', 'attributes' => ''];
    public $discount_value__datas = ['type' => 'text', 'label' => 'Valor do Desconto', 'oninput' => '', 'onblur' => '',
        'onchange' => '', 'min' => '', 'max' => '', 'attributes' => '', 'value' => ''];
    public $msg__datas = ['type' => 'text', 'label' => 'Mensagem a colocar no boleto', 'oninput' => '', 'onblur' => '',
        'onchange' => '', 'min' => '', 'max' => '', 'attributes' => '', 'onload' => "value_onload('msg')",
        'value' => ['Plano :plan (R$ :value)', 'plan' => ['plan', 'name'], 'value' => ['plan', 'value']]];

    public function client() {
        return $this->belongsTo(Client::class);
    }
    public function bankingCarnet() {
        return $this->belongsTo(Carnet::class);
    }
    public function banking() {
        return $this->belongsTo(Banking::class);
    }
}
