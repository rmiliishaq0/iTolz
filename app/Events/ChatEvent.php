<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public $id, public $message,public $user_sender=false){}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'chat.support';
    }



    public function broadcastWith(): array
    {
        return [
            'sender'=>$this->id,
            'message' =>$this->message,
            'user'=> $this->user_sender
        ];
    }

}
