<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $table='ekskul';
    protected $fillable =[
        'ekskul',
        'deskripsi',
        'harga',
        'created_at',
        'updated_at'
    ];
}
