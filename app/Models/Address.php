<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'UF',
        'client_id',
        'tipo',
        'coordinates',
    ];
    protected $table = 'adresses';

    public function client() {
        return $this->belongsTo(Cliente::class);
    }
}