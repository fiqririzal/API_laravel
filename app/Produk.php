<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable =[
        'item',
        'harga',
        'stok',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    public function produk_galeris(){
        return $this->belongsTo(produk_galeris::class,'id');
    }
}
