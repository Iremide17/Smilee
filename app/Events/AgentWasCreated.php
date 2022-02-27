<?php

namespace App\Events;

use App\Models\Agent;
use Illuminate\Queue\SerializesModels;

class AgentWasCreated
{
    use SerializesModels;

    
    public $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }
}
