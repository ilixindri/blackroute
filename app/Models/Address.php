<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['zip', 'logradouro', 'number', 'complemento', 'bairro', 'state', 'client_id', 'type', 'coordinates',];
    protected $table = 'adresses';

    public $zip__datas = ['type' => 'text', 'label' => 'CEP', 'oninput' => 'zipf(this)', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $logradouro__datas = ['type' => 'text', 'label' => 'Logradouro', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $number__datas = ['type' => 'number', 'label' => 'Número', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $complemento__datas = ['type' => 'text', 'label' => 'Complemento', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $bairro__datas = ['type' => 'text', 'label' => 'Bairro', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $state__datas = ['type' => 'text', 'label' => 'UF', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];
    public $type__datas = ['type' => 'select', 'label' => 'Tipo', 'oninput' => '', 'onblur' => '', 'onchange' => '',
        'options' => [['value' => 'business', 'text' => 'Comercial'], ['value' => 'residential', 'text' => 'Residencial']]];
    public $coordinates__datas = ['type' => 'text', 'label' => 'Coordenadas', 'oninput' => '', 'onblur' => '', 'onchange' => '', 'min' => '', 'max' => ''];

    public function client() {
        return $this->belongsTo(Cliente::class);
    }
}
