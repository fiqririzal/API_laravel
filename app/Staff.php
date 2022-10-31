<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable =[
        'nama',
        'jabatan',
        'created_at',
        'updated_at'
    ];
}
