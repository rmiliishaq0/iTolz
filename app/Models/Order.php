<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'duration',
        'amount',
        'order_id',
        'status',
        'product_type'
    ];
}
