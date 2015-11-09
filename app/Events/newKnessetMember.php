<?php

namespace KnessetRollCall\Events;

use Illuminate\Queue\SerializesModels;

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
