<?php

namespace App\Events;

use App\Models\SalingReviewChat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SalingReviewMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    public function __construct(SalingReviewChat $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn()
    {
        // Tentukan channel publik dengan nama unik berdasarkan progress_id
        return new Channel('saling-review.' . $this->chat->progress_id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->chat->id,
            'message' => $this->chat->message,
            'user_id' => $this->chat->user_id,
            'created_at' => $this->chat->created_at->format('H:i'),
            'user_name' => $this->chat->user->name,
        ];
    }
}
