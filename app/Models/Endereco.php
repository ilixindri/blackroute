<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'UF',
        'cliente_id',
        'tipo',
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}