<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class newKnessetMember extends Event
{
    use SerializesModels;

    public $KnessetMember;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($KnessetMember)
    {
        $this->KnessetMember = $KnessetMember;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
