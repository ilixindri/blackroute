<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'contract_id'];

    public function client() {
        return $this->belongsTo(Client::class);
    }
    public function contract() {
        return $this->belongsTo(Contract::class);
    }
}
