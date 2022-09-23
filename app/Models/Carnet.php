<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carnet extends Model
{
    use HasFactory;
    protected $fillable =[
        'parcels', 'fine', 'interest', 'banking_id',
        'client_id', 'carnet_id', 'status', 'cover',
        'link', 'carnet_link', 'pdf_carnet', 'pdf_cover',
        ];

    public $list = ['fields' => ['banking_id', 'carnet_id', 'status'], 'title' => 'Carnês',
        'buttons' => [
            'top' => [
                'create_carnet' => ['route' => 'clients.carnets.create', 'fields' => ['client' => ['object', 'id']],
                    'text' => 'Criar Carnê', 'icon' => ''],
                'create_billet' => ['route' => 'clients.billets.create', 'fields' => ['client' => ['object', 'id'],],
                    'text' => 'Criar Boleto', 'icon' => ''],
            ],
            'inline' => [
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
            ],
        ]
    ];
    public $forms = ['Carnê', 'routes' => [['clients.carnets.store', 'client' => 'id'], ['clients.carnets.update']],
        ['title' => 'Dados do Carnê', 'text' => 'Digite os dados do carnê.',
            'fields' => ['repeats', 'plan_name', 'value', 'expire_at', 'discount_value', 'msg'],
            'model' => '\App\Models\Carnet', 'relations' => []],
    ];

    public $banking_id__datas = ["type" => "number", "label" => "Banco"];
    public $carnet_id__datas = ["type" => "number", "label" => "Carnê no Gerencia Net"];
    public $status__datas = ["type" => "number", "label" => "Status"];

    public $repeats__datas = ['type' => 'number', 'label' => 'Parcelas', 'oninput' => '', 'onblur' => '',
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
        'onchange' => '', 'min' => '', 'max' => '', 'attributes' => '', 'value' => '', 'required' => false];
    public $msg__datas = ['type' => 'text', 'label' => 'Mensagem a colocar no boleto', 'oninput' => '', 'onblur' => '',
        'onchange' => '', 'min' => '', 'max' => '', 'attributes' => '', 'onload' => "value_onload('msg')",
        'value' => ['Plano :plan (R$ :value)', 'plan' => ['plan', 'name'], 'value' => ['plan', 'value']]];

    public function bankingBillets() {
        return $this->hasMany(BankingBillet::class);
    }
    public function client() {
        return $this->belongsTo(Client::class);
    }
    public function banking() {
        return $this->belongsTo(Banking::class);
    }

    public function delete() {
        $this->disabled = True;
        $this->save();
        return $this;
    }
//    public static function destroy($ids) {
//        $bankingCarnet = Carnet::find($ids)->first();
//        $bankingCarnet->disabled = True;
//        $bankingCarnet->save();
//    }
//    public static function scopeWhere($field, $value) {
//        foreach ($params as $key => $param) {
//            $query = $query->where($key, $param);
//        }
//        $query = Carnet::where($field, $value);
//        $query = $query->where('disabled', False);
//        return $query;
//    }
}
