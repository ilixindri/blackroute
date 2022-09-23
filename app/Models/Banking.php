<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

class Banking extends Model
{
    use HasFactory;
    protected $fillable =['name', 'client_id_production', 'client_secret_production', 'client_id_homologation',
        'client_secret_homologation', 'notification_url', 'fine', 'interest', 'sandbox'];
    protected $table = 'bankings';

    public $list = ['fields' => ['name', 'fine', 'interest', 'sandbox', 'type'], 'title' => 'API\'s',
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
    public $forms = ['Client', 'routes' => [['clients.store'], ['clients.update', 'client' => 'id']],
        ['title' => 'Dados Pessoais', 'text' => 'Digite os dados pessoais do cliente.',
            'view' => 'personal-data', 'fields' => ['name', 'email', 'rg', 'cpf', 'birth_date', 'phone', 'whatsapp', 'sex'],
            'model' => '\App\Models\Client', 'relations' => ['']],
        ['title' => 'Endereço', 'text' => 'Digite o endereço do cliente.', 'view' => 'address', 'model' => '\App\Models\Address',
            'fields' => ['type', 'zip', 'logradouro', 'number', 'complemento', 'bairro', 'state', 'coordinates',],
            'relations' => [['model' => 'adresses', 'index' => 0]]],
        ['title' => 'Circuito Primário', 'text' => 'Digite os dados do circuito primário do cliente', 'relations' => [''],
            'view' => 'primary-circuit', 'fields' => ['plan_id', 'user', 'password'], 'model' => '\App\Models\Client'],
        ['title' => 'Circuito Secundário', 'text' => 'Digite os dados do circuito secundário do cliente', 'relations' => [''],
            'view' => '', 'fields' => ['cto_id', 'splitter'], 'model' => '\App\Models\Client'],
        ['title' => 'Financeiro', 'text' => 'Digite os dados financeiros do cliente', 'view' => 'financial',
            'fields' => ['banking_id', 'expire_at', 'until_days', 'contract_id'], 'model' => '\App\Models\Client',
            'relations' => ['']],
    ];

    public $name__datas = ["type" => "text", "label" => "Nome"];
    public $client_id_production__datas = ["type" => "text", "label" => "Client ID Produção"];
    public $client_secret_production__datas = ["type" => "text", "label" => "Client Secret Produção"];
    public $client_id_homologation__datas = ["type" => "text", "label" => "Client ID Homologação"];
    public $client_secret_homologation__datas = ["type" => "text", "label" => "Client Secret Homologação"];
    public $notification_url__datas = ["type" => "text", "label" => "URL de notificação"];
    public $fine__datas = ["type" => "number", "label" => "Multa por atraso", "max" => 1000, "min" => 0];
    public $interest__datas = ["type" => "number", "label" => "Juros ao dia por atraso", "max" => 330, "min" => 0];
    public $sandbox__datas = ["type" => "select", "label" => "Modo de Homologação?", "options" => [["value" => 0, "text" => "Desabilitado"], ["value" => 1, "text" => "Habilitado"]]];

    public $type__datas = ["type" => "select", "label" => "GerenciaNet", "options" => [["value" => "gerencianet", "text" => "GerenciaNet"]]];

    public function __construct(array $attributes = [])
    {
        $path = Controller::join_paths([base_path(), "database", "migrations", "2022_09_07_191157_create_bankings_table.php"]);
        $myfile = fopen($path, "r") or die("Unable to open file!");
        $file =  fread($myfile, filesize($path));
        foreach (explode("\n", $file) as $number => $line) {
            $line = trim($line);
            if (substr($line, 0, strlen('$table->')) === '$table->') {
                // explode("", $line);//preencher o lenght dos varchar
            }
        }
        fclose($myfile);
        // exit();
        parent::__construct($attributes);
    }
    protected static function booted()
    {
        static::retrieved(function ($model) {
            $model->what(); //called once all attributes are loaded
        });
    }
    public function what() {
        if ($this->sandbox != 0) {
            $this->client_id = $this->client_id_homologation;
            $this->client_secret = $this->client_secret_homologation;
        } else {
            $this->client_id = $this->client_id_production;
            $this->client_secret = $this->client_secret_production;
        }
    }

    public function clients() {
        return $this->hasMany(Client::class);
    }
    public function bankingCarnets() {
        return $this->hasMany(Carnet::class);
    }
    public function bankingBillets() {
        return $this->hasMany(BankingBillet::class);
    }
}
