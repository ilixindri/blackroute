<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankingBillet extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'carnet_id', 'charge_id', 'parcel', 'status', 
        'value', 'expire_at', 'url', 'parcel_link', 'pdf_charge', 'barcode', 
        'pix_qrcode', 'pix_qrcode_image', 'fine', 'interest'];

    public function client() {
        return $this->belongsTo(Client::class);
    }
    public function bankingCarnet() {
        return $this->belongsTo(BankingCarnet::class);
    }
    public function banking() {
        return $this->belongsTo(Banking::class);
    }
}
