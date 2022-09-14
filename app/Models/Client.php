<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable =[
//        'id',
        'name',
        'email',
        'rg',
        'cpf',
        'phone',
        'whatsapp',
        'birth_date',
        'sexo',
        'banking_id',
        'disabled',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($client) {
                $client->adresses()->delete();
        });
    }

    public function adresses() {
        return $this->hasMany(Address::class);
    }

    public function bankingBillets() {
        return $this->hasMany(BankingBillet::class);
    }

    public function bankingCarnets() {
        return $this->hasMany(BankingCarnet::class);
    }

    public function banking() {
        return $this->belongsTo(Banking::class);
    }
}
