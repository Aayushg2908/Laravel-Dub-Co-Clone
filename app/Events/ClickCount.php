<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClickCount implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $linkId;
    public $clickCount;

    /**
     * Create a new event instance.
     */
    public function __construct($linkId, $clickCount)
    {
        $this->linkId = $linkId;
        $this->clickCount = $clickCount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('click-count-increment'),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'linkId' => $this->linkId,
            'clickCount' => $this->clickCount,
        ];
    }
}
