<?php

namespace App\Http\Livewire\Pages\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UpdateProfileForm extends Component
{
    public User $user;
    public $profile = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->profile = Auth::user()->profile->toArray();
    }

    public function updateSocialLink()
    {
        $this->user->profile()->update([
            'level'         => $this->profile['level'],
            'bio'         => $this->profile['bio'],
            'facebook'         => $this->profile['facebook'],
            'twitter'         => $this->profile['twitter'],
            'instagram'         => $this->profile['instagram'],
            'linkedin'         => $this->profile['linkedin'],
        ]);

    }

    public function render()
    {
        return view('livewire.pages.profile.update-profile-form');
    }
}