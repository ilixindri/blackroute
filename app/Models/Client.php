<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'rg', 'cpf', 'phone', 'whatsapp', 'birth_date', 'sexo', 'banking_id',
        'disabled', 'expire_at', 'plan_id', 'until_days', 'contract_id'];

    public $forms = [
        ['title' => 'Dados Pessoais', 'text' => 'Digite os dados pessoais do cliente.',
            'view' => 'personal-data', 'fields' => ['name', 'email', 'rg', 'cpf', 'phone', 'whatsapp', 'birth_date', 'sexo']],
        ['title' => 'Endereço', 'text' => 'Digite o endereço do cliente.', 'view' => 'address'],
        ['title' => 'Financeiro', 'text' => 'Digite os dados financeiros do cliente', 'view' => 'financial',
            'fields' => ['banking_id', 'expire_at', 'until_days', 'contract_id']],
        ['title' => 'Circuito Primário', 'text' => 'Digite os dados do circuito primário do cliente',
            'view' => 'primary-circuit', 'fields' => ['plan_id']]];
    public $banking_id__datas = ['type' => 'select', 'label' => 'Gateway', 'options' => ['model' => '\App\Models\Banking', 'text' => ['name']]];
    public $expire_at__datas = ['type' => 'number', 'label' => 'Dia de Vencimento'];
    public $until_days__datas = ['type' => 'number', 'label' => 'Dias para bloqueio'];
    public $contract_id__datas = ['type' => 'select', 'label' => 'Contrato', 'options' => ['model' => '\App\Models\Contract', 'text' => ['name']]];
    public $plan_id__datas = ['type' => 'select', 'label' => 'Contrato', 'options' => ['model' => '\App\Models\Plan', 'text' => ['name', 'value']]];


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($client) {
                $client->adresses()->delete();
        });
    }
    public function delete() {
        $this->disabled = True;
        $this->save();
        return $this;
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
    public function plan() {
        return $this->belongsTo(Plan::class);
    }
}
