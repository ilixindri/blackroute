<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cto extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'splitter',];
    public $forms = [
        ['title' => 'Dados da Cto', 'text' => 'Digite os dados da cto.',
            'view' => '', 'fields' => ['name', 'splitter'],
            'model' => '\App\Models\Cto', 'relations' => ['']],
    ];
    public $name__datas = ['type' => 'text', 'label' => 'Nome', 'oninput' => '', 'onblur' => ''];
    public $splitter__datas = ['type' => 'number', 'label' => 'Quantidade de Splitter', 'oninput' => '', 'onblur' => ''];
    public $EXAMPLE_SELECT_DEFAULT__datas = ['type' => 'select', 'label' => 'Cto', 'oninput' => '', 'onblur' => '',
        'options' => ['model' => '\App\Models\Cto', 'text' => ['name']]];
    public $EXAMEPLE_SELECT_RANGE_NUMBER__datas = ['type' => 'select', 'label' => 'Splitter', 'oninput' => '', 'onblur' => '',
        'options' => ['type' => 'range', 'min' => '1',
            'max' => ['model' => '\App\Model\Cto', 'id' => 'cto_id', 'field' => 'splitter']]];

}
