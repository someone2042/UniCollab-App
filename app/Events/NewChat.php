<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message;
    public $sender_id;
    public $receiver_id;
    public $time;
    public $id;

    public function __construct($message, $sender_id, $receiver_id, $id)
    {
        //
        $this->message = $message;
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
        $this->id = $id;
        $this->time = Carbon::now();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        if ($this->sender_id > $this->receiver_id) {
            return [
                "chat.$this->sender_id.$this->receiver_id",
            ];
        } else {
            return [
                "chat.$this->receiver_id.$this->sender_id",
            ];
        }
    }

    public function broadcastAs(): string
    {
        return 'new-chat';
    }
}
