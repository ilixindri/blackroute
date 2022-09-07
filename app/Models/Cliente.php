<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable =[
        'nome',
        'email',
        'rg',
        'cpf',
        'phone',
        'whatsapp',
        'data_nascimento',
        'sexo',
        'disabled',
    ];

    public function enderecos() {
        return $this->hasMany(Endereco::class);
    }
    
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($cliente) {
                $cliente->enderecos()->delete();
        });
    }
}

