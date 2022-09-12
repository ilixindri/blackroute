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
}
