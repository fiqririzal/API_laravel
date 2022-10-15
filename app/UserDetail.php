<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable =[
        'user_id','address','phone','nama_anak','kelamin'
    ];
}
