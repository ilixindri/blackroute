<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'value', 'until_days','conditional_discount_type', 'conditional_discount_value', 'disabled'];
    public $name__datas = ['type' => 'text', 'label' => 'Nome'];
    public $value__datas = ['type' => 'number', 'label' => 'Valor'];
    public $until_days__datas = ['type' => 'number', 'label' => 'Dias Antes Para Desconto Para Pagamento Antecipado'];
    public $discount_type__datas = ['type' => 'number', 'label' => 'Tipo de Desconto'];
    public $discount_value__datas = ['type' => 'number', 'label' => 'Valor do Desconto'];

    public function delete() {
        $this->disabled = True;
        $this->save();
        return $this;
    }

    public function clients() {
        return $this->hasMany(Client::class);
    }
}
