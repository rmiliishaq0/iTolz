<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSupport extends Model
{
    protected $fillable = [
        'sender',
        'to',
        'message',
        'readAt'
    ];

    protected $table = 'chat_supports';
}
