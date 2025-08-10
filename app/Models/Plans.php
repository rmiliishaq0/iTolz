<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $table = 'product_user';

    protected $fillable = [
        'user_id',
        'product_id',
        'expire_At',
    ];
}
