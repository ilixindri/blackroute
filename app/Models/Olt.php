<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olt extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    const menu = ['Olts', 'a'];
    public static $list = ['Olts', 'fields' => ['name'],
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
    public static $forms = ['Olts',
        ['title' => 'Dados da Olt', 'text' => 'Digite os dados da Olt.',
            'view' => '', 'fields' => ['name', 'ports'],
            'model' => '\App\Models\Olt', 'relations' => []],
    ];
    public $tests = [
        [
            ['name' => 'Olt 2', 'ports' => 'random.randint(1, 32)']
        ]
    ];
    public static $name__datas = ['type' => 'text', 'label' => 'Nome'];
}
