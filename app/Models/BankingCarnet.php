<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankingCarnet extends Model
{
    use HasFactory;

    protected $fillable =['client_id', 'carnet_id', 'status', 'cover', 
        'link', 'carnet_link', 'pdf_carnet', 'pdf_cover'];

    public function bankingBillets() {
        return $this->hasMany(BankingBillet::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }
}