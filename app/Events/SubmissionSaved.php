<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SubmissionSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $submission;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($submission)
    {
        $this->submission = $submission;
    }
}
