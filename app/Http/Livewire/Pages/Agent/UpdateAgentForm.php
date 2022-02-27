<?php

namespace App\Http\Livewire\Pages\Agent;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UpdateAgentForm extends Component
{
    public User $user;
    public $agent = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->agent = Auth::user()->agent->toArray();
    }

    public function updateSocialLink()
    {
        $this->user->agent()->update([
            'level'         => $this->agent['level'],
            'bio'         => $this->agent['bio'],
            'facebook'         => $this->agent['facebook'],
            'twitter'         => $this->agent['twitter'],
            'instagram'         => $this->agent['instagram'],
            'linkedin'         => $this->agent['linkedin'],
        ]);

    }
    
    public function render()
    {
        return view('livewire.pages.agent.update-agent-form');
    }
}
