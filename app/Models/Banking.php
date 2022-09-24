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
    const menu = ['Gateways', 'o', 'Gateway de Pagamento'];

    public $list = ['fields' => ['name', 'fine', 'interest', 'sandbox', 'type'], 'title' => 'Gateways de Pagamento',
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
            'fields' => ['name', 'client_id_production', 'client_secret_production',
                'client_id_homologation', 'client_secret_homologation', 'notification_url', 'fine', 'interest', 'sandbox'],
            'model' => '\App\Models\Banking', 'relations' => []],
    ];
    public $tests = [
        ['name' => 'Gateway 1', 'client_id_production' => 'Client_Id_20e76e030a3e1205b2809decf93bffc037f50433',
            'client_secret_production' => 'Client_Secret_61d98106b240fb26e7e77f2c33139d1f72a06ca9',
            'client_id_homologation' => 'Client_Id_5f7bab7a270542b3cc47f987b2a518273d20ddc9',
            'client_secret_homologation' => 'Client_Secret_a9aba34e50a8f9f320072e2b8eb03d257eac169c',
            'notification_url' => 'domain.com', 'fine' => '0', 'interest' => '0', 'sandbox' => '1'],
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
