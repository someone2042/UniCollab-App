<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $groupId;
    public $userId;
    public $time;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $groupId, $userId)
    {
        //
        $this->message = $message;
        $this->groupId = $groupId;
        $this->userId = $userId;
        $this->time = Carbon::now();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            "group.$this->groupId",
        ];
    }
    public function broadcastAs(): string
    {
        return 'new-chat-message';
    }
}
