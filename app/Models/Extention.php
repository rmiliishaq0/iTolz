<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extention extends Model
{
    protected $table = 'extensions';

    protected $fillable = [
        'extension_id',
        'token'
    ];
}
