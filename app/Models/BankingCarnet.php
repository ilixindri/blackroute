<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankingCarnet extends Model
{
    use HasFactory;
    protected $fillable =[
        'parcels', 'fine', 'interest', 'banking_id',

        'client_id', 'carnet_id', 'status', 'cover',
        'link', 'carnet_link', 'pdf_carnet', 'pdf_cover',
        ];
        //'parcels', 'fine', 'interest',];
//    public $displayable = ['parcels', 'fine', 'interest',];
    public $parcels__datas = ["type" => "number", "label" => "Parcelas"];
    public $fine__datas = ["type" => "number", "label" => "Multa"];
    public $interest__datas = ["type" => "number", "label" => "Juros"];

    public function bankingBillets() {
        return $this->hasMany(BankingBillet::class);
    }
    public function client() {
        return $this->belongsTo(Client::class);
    }
    public function banking() {
        return $this->belongsTo(Banking::class);
    }

    public function delete() {
        $this->disabled = True;
        $this->save();
        return $this;
    }
//    public static function destroy($ids) {
//        $bankingCarnet = BankingCarnet::find($ids)->first();
//        $bankingCarnet->disabled = True;
//        $bankingCarnet->save();
//    }
//    public static function scopeWhere($field, $value) {
//        foreach ($params as $key => $param) {
//            $query = $query->where($key, $param);
//        }
//        $query = BankingCarnet::where($field, $value);
//        $query = $query->where('disabled', False);
//        return $query;
//    }
}
