<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olt extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'ports', 'ip', 'ssh_port', 'ssh_user', 'ssh_pass'];
    const menu = ['Olts', 'a'];
    public $list = ['Olts', 'fields' => ['name'],
        'routes' => [
            'top' => [
                'create' => ['route' => 'create', 'fields' => [['key' => '', 'value' => ''],], 'text' => 'Novo Contrato', 'icon' => ''],
            ],
            'inline' => [
                'edit' => ['route' => 'edit', 'text' => 'Editar',
                    'icon' => 'fa-regular fa-pen-to-square', 'method' => 'GET',
                    'onclick' => ['function' => 'formf', 'params' => [['type' => 'text', 'value' => ['raw' => 'edit:id', 'variables' => ['id' => 'id']]]]]],
                'delete' => ['route' => 'destroy',
                    'text' => 'Deletar', 'icon' => 'fa-regular fa-trash-can', 'method' => 'DELETE', 'onclick' => ['function' => 'formfc',
                        'params' => [['type' => 'text', 'value' => ['raw' => 'delete:id', 'variables' => ['id' => 'id']]], ['type' => 'text',//text/variable -> variable: ['type'=>'variable', 'value' => 'name']
                            'value' => ['raw' => 'O cliente :client será excluído do sistema. Clique Ok para Deletar?', 'variables' => ['client' => 'name']]]]]],
            ],
        ]
    ];
    public $forms = ['Olts',
        ['title' => 'Dados da Olt', 'text' => 'Digite os dados da Olt.',
            'fields' => ['name', 'ports', 'ip', 'ssh_port', 'ssh_user', 'ssh_pass'],
            'model' => '\App\Models\Olt', 'relations' => []],
    ];
    public $tests = [
        [
            ['name' => "olt()", 'ports' => 'olt_ports()', 'ip' => 'create_ip()', 'ssh_port' => 'random.randint(1, 63000)', 'ssh_user' => 'admin', 'ssh_pass' => 'admin']
        ]
    ];
    public $name__datas = ['type' => 'text', 'label' => 'Nome'];
    public $ports__datas = ['text', 'Portas'];
    public $ip__datas = ['text', 'IP'];
    public $ssh_port__datas = ['number', 'Porta SSH'];
    public $ssh_user__datas = ['text', 'Usu&aacute;rio SSH'];
    public $ssh_pass__datas = ['text', 'Senhah SSH'];
}
