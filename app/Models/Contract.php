<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    public $list = ['fields' => [], 'title' => 'Contratos',
        'routes' => [
            'create' => ['route' => 'contracts.create', 'fields' => [['key' => '', 'value' => ''],], 'text' => 'Novo Contrato', 'icon' => ''],
            'financial' => ['route' => 'clients.carnets.index', 'fields' => [['key' => 'client', 'value' => 'id'],],
                'text' => 'Financeiro', 'icon' => 'fa-regular fa-dollar-sign',
                'method' => 'GET', 'onclick' => ['function' => 'formf', 'params' => [['type' => 'text', 'value' => ['raw' => 'financial:id', 'variables' => ['id' => 'id']]]]]],
            'edit' => ['route' => 'clients.edit', 'fields' => [['key' => 'client', 'value' => 'id'],], 'text' => 'Editar',
                'icon' => 'fa-regular fa-pen-to-square', 'method' => 'GET',
                'onclick' => ['function' => 'formf', 'params' => [['type' => 'text', 'value' => ['raw' => 'edit:id', 'variables' => ['id' => 'id']]]]]],
            'delete' => ['route' => 'clients.destroy', 'fields' => [['key' => 'client', 'value' => 'id'],],
                'text' => 'Deletar', 'icon' => 'fa-regular fa-trash-can', 'method' => 'DELETE', 'onclick' => ['function' => 'formfc',
                    'params' => [['type' => 'text', 'value' => ['raw' => 'delete:id', 'variables' => ['id' => 'id']]], ['type' => 'text',//text/variable -> variable: ['type'=>'variable', 'value' => 'name']
                        'value' => ['raw' => 'O cliente :client será excluído do sistema. Clique Ok para Deletar?', 'variables' => ['client' => 'name']]]]]],
        ]
    ];
    public $forms = ['Boleto', 'routes' => [['contracts.store'], ['clients.billets.update']],
        ['title' => 'Dados do Boleto', 'text' => 'Digite os dados do boleto.',
            'fields' => ['quantity', 'plan_name', 'value', 'expire_at', 'discount_value', 'msg'],
            'model' => '\App\Models\BankingBillet', 'relations' => []],
    ];
}
