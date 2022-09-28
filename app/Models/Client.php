<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'rg', 'cpf', 'phone', 'whatsapp', 'birth_date', 'sex', 'user', 'password',
        'expire_at', 'until_days', 'splitter', 'cto_id', 'banking_id', 'plan_id', 'mac','ip','mode','disabled'];
    const menu = ['Clientes', 'o'];

    public $list = ['fields' => ['id', 'name', 'email', 'cpf'], 'title' => 'Clientes',
        'buttons' => [
            'top' => [
                'create' => ['route' => 'create', 'text' => 'Novo Cliente', 'icon' => ''],
            ],
            'inline' => [
                'financial' => ['route' => 'index',
                    'id' => [':action:id', 'action' => 'action', 'id' => ['id']],
                    'text' => 'Financeiro', 'icon' => 'fa-regular fa-dollar-sign',
                    'method' => 'GET', 'onclick' => ['formf(\':action:id\')', 'action' => 'action', 'id' => ['id']]],
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
    public $forms = ['Client',
        ['title' => 'Dados Pessoais', 'text' => 'Digite os dados pessoais do cliente.',
            'view' => 'personal-data', 'fields' => ['name', 'email', 'rg', 'cpf', 'birth_date', 'phone', 'whatsapp', 'sex'],
            'model' => '\App\Models\Client', 'relations' => ['']],
        ['title' => 'Endereço', 'text' => 'Digite o endereço do cliente.', 'view' => 'address', 'model' => '\App\Models\Address',
            'fields' => ['type', 'zip', 'logradouro', 'number', 'complemento', 'bairro', 'state', 'coordinates',],
            'relations' => [['model' => 'adresses', 'index' => 0]]],
        ['title' => 'Circuito Primário', 'text' => 'Digite os dados do circuito primário do cliente', 'relations' => [''],
            'view' => 'primary-circuit', 'fields' => ['mode', 'user', 'password', 'mac', 'ip', 'plan_id'], 'model' => '\App\Models\Client'],
        ['title' => 'Circuito Secundário', 'text' => 'Digite os dados do circuito secundário do cliente', 'relations' => [''],
            'view' => '', 'fields' => ['cto_id', 'splitter'], 'model' => '\App\Models\Client'],
        ['title' => 'Financeiro', 'text' => 'Digite os dados financeiros do cliente', 'view' => 'financial',
            'fields' => ['banking_id', 'expire_at', 'until_days', 'contract_id'], 'model' => '\App\Models\Client',
            'relations' => ['']],
    ];
    public $tests = [
        [
            ['name' => 'name_generator()', 'email' => 'alexandrogonsan@outlook.com', 'rg' => 'random.randint(10000000, 99999999)',
                'cpf' => 'random.randint(1000000000, 9999999999)', 'birth_date' => 'generate_birth_date()', 'phone' => 'random.randint(10000000000, 99999999999)',
                'whatsapp' => 'random.randint(10000000000, 99999999999)', 'sex' => 'random.choice([\'male\', \'female\'])'],
            ['type' => 'random.choice([\'business\', \'residential\'])', 'zip' => '69312214',
                'logradouro' => 'None', 'number' => 'random.randint(1, 2000)', 'complemento' => 'None', 'bairro' => 'None', 'state' => 'None', 'coordinates' => '-1,-1'],
            ['mode' => 'random.choice([\'pppoe\', \'ipoe\'])', 'user' => 'name.lower()', 'password' => '123', 'mac' => 'create_mac()',
                'ip' => 'create_ip()', 'plan_id' => '1'],
            ['cto_id' => '1', 'splitter' => '2'],
            ['banking_id' => '1', 'expire_at' => '1', 'until_days' => '45', 'contract_id' => '1'],
        ],
    ];
    public $id__datas = ['type' => 'number', 'label' => 'Id', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $name__datas = ['type' => 'text', 'label' => 'Nome', 'oninput' => '', 'onblur' => 'namef(this)', 'onchange' => '', 'min' => '', 'max' => ''];
    public $email__datas = ['type' => 'email', 'label' => 'Email', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'max' => '', 'min' => ''];
    public $rg__datas = ['type' => 'text', 'label' => 'RG', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $cpf__datas = ['type' => 'text', 'label' => 'CPF', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $phone__datas = ['type' => 'tel', 'label' => 'Telefone', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $whatsapp__datas = ['type' => 'tel', 'label' => 'WhatsApp', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $birth_date__datas = ['type' => 'date', 'label' => 'Data de nascimento', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => '9999-12-31'];
    public $sex__datas = ['type' => 'select', 'label' => 'Sexo', 'oninput' => '', 'onblur' => '', 'onchange' => '',
        'options' => [['value' => 'female', 'text' => 'Feminino'], ['value' => 'male', 'text' => 'Masculino'],]];
    public $user__datas = ['type' => 'text', 'label' => 'Usuário', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $password__datas = ['type' => 'text', 'label' => 'Senha', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $expire_at__datas = ['type' => 'number', 'label' => 'Dia de Vencimento', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'max' => 31, 'min' => ''];
    public $until_days__datas = ['type' => 'number', 'label' => 'Dias para bloqueio', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'max' => 65535, 'min' => ''];
    public $mac__datas = ['type' => 'text', 'label' => 'MAC', 'oninput' => 'macf(this)'];
    public $ip__datas = ['type' => 'text', 'label' => 'IP', 'oninput' => 'ipf(this)'];
    public $mode__datas = ['type' => 'select', 'label' => 'Modo', 'options' => ['pppoe' => 'PPPOE', 'ipoe' => 'IPOE']];
    public $splitter__datas = ['type' => 'select', 'label' => 'Splitter', 'oninput' => '', 'onblur' => '', 'onchange' => '',
        'options' => ['type' => 'range', 'min' => '1',
            'max' => ['model' => '\App\Models\Cto', 'id' => 'cto_id', 'field' => 'splitter']]];
    public $cto_id__datas = ['type' => 'select', 'label' => 'Cto', 'oninput' => '', 'onblur' => '', 'onchange' => 'ctof(this)',
        'options' => ['model' => '\App\Models\Cto', 'text' => ['name']]];
    public $contract_id__datas = ['type' => 'select', 'label' => 'Contrato', 'multiple' => 'Agreement', 'oninput' => '', 'onblur' => '', 'onchange' => '',
        'options' => ['model' => '\App\Models\Contract', 'text' => ['name'], 'value' => ['contract']]];
    public $banking_id__datas = ['type' => 'select', 'label' => 'Gateway de Pagamento', 'onchange' => '',
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

    public function adresses() {
        return $this->hasMany(Address::class);
    }
    public function bankingBillets() {
        return $this->hasMany(BankingBillet::class);
    }
    public function bankingCarnets() {
        return $this->hasMany(Carnet::class);
    }
    public function agreements() {
        return $this->hasMany(Agreement::class);
    }

    public function banking() {
        return $this->belongsTo(Banking::class);
    }
    public function plan() {
        return $this->belongsTo(Plan::class);
    }
    public function cto() {
        return $this->belongsTo(Cto::class);
    }
}
