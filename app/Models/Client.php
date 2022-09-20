<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'rg', 'cpf', 'phone', 'whatsapp', 'birth_date', 'sex', 'user', 'password',
        'expire_at', 'until_days', 'splitter', 'cto_id', 'banking_id', 'plan_id', 'contract_id', 'disabled'];

    public $list = ['fields' => ['id', 'name', 'email', 'cpf'], 'title' => 'Clientes',
        'routes' => [
            'create' => ['route' => 'clients.create', 'fields' => [['key' => '', 'value' => ''],], 'text' => 'Novo Cliente', 'icon' => ''],
            'financial' => ['route' => 'clients.carnets.index', 'fields' => [['key' => 'client', 'value' => 'id'],],
                'text' => 'Financeiro', 'icon' => 'fa-regular fa-dollar-sign',
                'method' => 'GET', 'onclick' => ['function' => 'formf', 'params' => [['type' => 'text', 'value' => ['raw' => 'financial', 'variables' => []]]]]],
            'edit' => ['route' => 'clients.edit', 'fields' => [['key' => 'client', 'value' => 'id'],], 'text' => 'Editar',
                'icon' => 'fa-regular fa-pen-to-square', 'method' => 'GET',
                'onclick' => ['function' => 'formf', 'params' => [['type' => 'text', 'value' => ['raw' => 'edit', 'variables' => []]]]]],
            'delete' => ['route' => 'clients.destroy', 'fields' => [['key' => 'client', 'value' => 'id'],],
                'text' => 'Deletar', 'icon' => 'fa-regular fa-trash-can', 'method' => 'DELETE', 'onclick' => ['function' => 'formfc',
                    'params' => [['type' => 'text', 'value' => ['raw' => 'delete', 'variables' => []]], ['type' => 'text',//text/variable -> variable: ['type'=>'variable', 'value' => 'name']
                        'value' => ['raw' => 'O cliente :client será excluído do sistema. Clique Ok para Deletar?', 'variables' => ['client' => 'name']]]]]],
        ]
    ];
    public $forms = [
        ['title' => 'Dados Pessoais', 'text' => 'Digite os dados pessoais do cliente.',
            'view' => 'personal-data', 'fields' => ['name', 'email', 'rg', 'cpf', 'birth_date', 'phone', 'whatsapp', 'sex'],
            'model' => '\App\Models\Client', 'relations' => ['']],
        ['title' => 'Endereço', 'text' => 'Digite o endereço do cliente.', 'view' => 'address', 'model' => '\App\Models\Address',
            'fields' => ['type', 'zip', 'logradouro', 'number', 'complemento', 'bairro', 'state', 'coordinates',],
            'relations' => [['model' => 'adresses', 'index' => 0]]],
        ['title' => 'Financeiro', 'text' => 'Digite os dados financeiros do cliente', 'view' => 'financial',
            'fields' => ['banking_id', 'expire_at', 'until_days', 'contract_id'], 'model' => '\App\Models\Client',
            'relations' => ['']],
        ['title' => 'Circuito Primário', 'text' => 'Digite os dados do circuito primário do cliente', 'relations' => [''],
            'view' => 'primary-circuit', 'fields' => ['plan_id', 'user', 'password'], 'model' => '\App\Models\Client'],
        ['title' => 'Circuito Secundário', 'text' => 'Digite os dados do circuito secundário do cliente', 'relations' => [''],
            'view' => '', 'fields' => ['cto_id', 'splitter'], 'model' => '\App\Models\Client'],
    ];
    public $id__datas = ['type' => 'number', 'label' => 'Id', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $name__datas = ['type' => 'text', 'label' => 'Nome', 'oninput' => '', 'onblur' => 'namef(this)', 'onchange' => '', 'min' => '', 'max' => ''];
    public $email__datas = ['type' => 'email', 'label' => 'Email', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'max' => '', 'min' => ''];
    public $rg__datas = ['type' => 'text', 'label' => 'RG', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $cpf__datas = ['type' => 'text', 'label' => 'CPF', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $phone__datas = ['type' => 'text', 'label' => 'Telefone', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $whatsapp__datas = ['type' => 'text', 'label' => 'WhatsApp', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $birth_date__datas = ['type' => 'date', 'label' => 'Data de nascimento', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => '9999-12-31'];
    public $sex__datas = ['type' => 'select', 'label' => 'Sexo', 'oninput' => '', 'onblur' => '', 'onchange' => '',
        'options' => [['value' => 'female', 'text' => 'Feminino'], ['value' => 'male', 'text' => 'Masculino'],]];
    public $user__datas = ['type' => 'text', 'label' => 'Usuário', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $password__datas = ['type' => 'text', 'label' => 'Senha', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $expire_at__datas = ['type' => 'number', 'label' => 'Dia de Vencimento', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'max' => 31, 'min' => ''];
    public $until_days__datas = ['type' => 'number', 'label' => 'Dias para bloqueio', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'max' => 65535, 'min' => ''];
    public $splitter__datas = ['type' => 'select', 'label' => 'Splitter', 'oninput' => '', 'onblur' => '', 'onchange' => '',
        'options' => ['type' => 'range', 'min' => '1',
            'max' => ['model' => '\App\Models\Cto', 'id' => 'cto_id', 'field' => 'splitter']]];
    public $cto_id__datas = ['type' => 'select', 'label' => 'Cto', 'oninput' => '', 'onblur' => '', 'onchange' => 'ctof(this)',
        'options' => ['model' => '\App\Models\Cto', 'text' => ['name']]];
    public $contract_id__datas = ['type' => 'select', 'label' => 'Contrato', 'oninput' => '', 'onblur' => '', 'onchange' => '',
        'options' => ['model' => '\App\Models\Contract', 'text' => ['name']]];
    public $banking_id__datas = ['type' => 'select', 'label' => 'Gateway', 'onchange' => '',
        'options' => ['model' => '\App\Models\Banking', 'text' => ['name']], 'oninput' => '', 'onblur' => ''];
    public $plan_id__datas = ['type' => 'select', 'label' => 'Plano', 'oninput' => '', 'onblur' => '', 'onchange' => '',
        'options' => ['model' => '\App\Models\Plan', 'text' => ['raw' => ':plan - R$ :value', 'variables' => ['plan' => 'name', 'value' => 'value']]]];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($client) {
                $client->adresses()->delete();
        });
    }
    public function delete() {
        $this->disabled = True;
        $this->save();
        return $this;
    }

    public function adresses() {
        return $this->hasMany(Address::class);
    }

    public function bankingBillets() {
        return $this->hasMany(BankingBillet::class);
    }

    public function bankingCarnets() {
        return $this->hasMany(BankingCarnet::class);
    }

    public function banking() {
        return $this->belongsTo(Banking::class);
    }
    public function plan() {
        return $this->belongsTo(Plan::class);
    }
}
