<?php

namespace KnessetRollCall\Events;

use Illuminate\Queue\SerializesModels;

class errorFetchingLogEntries extends Event
{
    use SerializesModels;

    public $error;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($error)
    {
        $this->error = $error;
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
