<?php

namespace App\Mail;

use App\Models\Agent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAgentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("New Agent Registration: {$this->agent->name()} { - } {$this->agent->name()}")
            ->markdown('emails.new_agent');
    }
}
