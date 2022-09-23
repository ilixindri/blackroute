<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'value', 'until_days','conditional_discount_type', 'conditional_discount_value', 'disabled'];
    const menu = ['Planos', 'o', 'Plano'];

    public $list = ['fields' => ['name', 'value'], 'title' => 'Planos',
        'buttons' => [
            'top' => [
                'create' => ['route' => 'create', 'text' => 'Novo Gateway de Pagamento', 'icon' => ''],
            ],
            'inline' => [
                'edit' => ['route' => 'edit', 'text' => 'Editar',
                    'id' => [':action:id', 'action' => 'action', 'id' => ['id']],
                    'icon' => 'fa-regular fa-pen-to-square', 'method' => 'GET',
                    'onclick' => ['formf(\':action:id\')', 'action' => 'action', 'id' => ['id']]],
                'delete' => ['route' => 'destroy',
                    'id' => [':action:id', 'action' => 'action', 'id' => ['id']],
                    'text' => 'Deletar', 'icon' => 'fa-regular fa-trash-can', 'method' => 'DELETE',
                    'onclick' => ['formfc(\':id_form\',\'O cliente :client será excluído do sistema. Clique Ok para Deletar?\')',
                        'id_form' => 'id_form', 'client' => ['name']]],
            ],
        ],
    ];
    public $forms = ['Gateway de Pagamento',
        ['title' => 'Dados do GerenciaNet', 'text' => 'Digite os dados da sua api do Gerencia Net.',
            'fields' => ['name', 'value', 'until_days', 'discount_value'],
            'model' => '\App\Models\Plan', 'relations' => []],
    ];

    public $name__datas = ['type' => 'text', 'label' => 'Nome'];
    public $value__datas = ['type' => 'number', 'label' => 'Valor'];
    public $until_days__datas = ['type' => 'number', 'label' => 'Dias Antes Para Desconto Para Pagamento Antecipado'];
    public $discount_type__datas = ['type' => 'number', 'label' => 'Tipo de Desconto'];
    public $discount_value__datas = ['type' => 'number', 'label' => 'Valor do Desconto'];

    public function delete() {
        $this->disabled = True;
        $this->save();
        return $this;
    }

    public function clients() {
        return $this->hasMany(Client::class);
    }
}
