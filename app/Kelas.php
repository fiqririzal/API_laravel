<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable =[
        'kelas',
        'keterangan',
        'harga',
        'created_at',
        'update_at',
    ];
}
