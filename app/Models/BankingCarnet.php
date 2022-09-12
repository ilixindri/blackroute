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
    public static function destroy($ids) {
        $bankingCarnet = BankingCarnet::find($ids)->first();
        $bankingCarnet->disabled = True;
        $bankingCarnet->save();
    }
//    public static function scopeWhere($field, $value) {
//        foreach ($params as $key => $param) {
//            $query = $query->where($key, $param);
//        }
//        $query = BankingCarnet::where($field, $value);
//        $query = $query->where('disabled', False);
//        return $query;
//    }
}
