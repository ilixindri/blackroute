<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable =[
        // 'id',
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

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($cliente) {
                $cliente->enderecos()->delete();
        });
    }

    public function enderecos() {
        return $this->hasMany(Endereco::class);
    }
    
    public function bankingBillets() {
        return $this->hasMany(BankingBillet::class);
    }

    public function bankingCarnets() {
        return $this->hasMany(BankingCarnet::class);
    }
}