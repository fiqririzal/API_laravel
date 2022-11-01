<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class cart_register extends Model
{
    protected $table='cart_register';
    protected $append=['total_pembayaran'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ekskul(){
        return $this->belongsTo(ekskul::class);
    }

    public function getGrandTotalAttribute(){
        return DB::table('cart_register')
            ->select(DB::raw('SUM(total_price * quantity)'))
            ->where('receipt_id',$this->id)
            ->value("SUM(total_price*quantity)");
    }
}
