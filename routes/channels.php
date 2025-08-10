<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{user_id}', function (User $user, $user_id) {
     return (int) $user->id === (int) $user_id || $user->isAdmin ==1;
});


