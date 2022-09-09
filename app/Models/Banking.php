<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banking extends Model
{
    use HasFactory;
    protected $fillable =['client_id_production', 'client_secret_production', 'client_id_homologation', 
        'client_secret_homologation', 'type', 'fine', 'interest', 'sandbox'];
    public $client_id_production = ["type" => "text", "label" => "Client ID Produção"];
    // ', 'client_secret_production', 'client_id_homologation', 
    // 'client_secret_homologation', 'type', 'fine', 'interest', 'sandbox'
}
