<?php

namespace App\Http\Livewire\Pages\Writer;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UpdateWriterForm extends Component
{
    public User $user;
    public $writer = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->writer = Auth::user()->writer->toArray();
    }

    public function updateWriterLink()
    {
        $this->user->writer()->update([
            'bio'         => $this->writer['bio'],
            'facebook'         => $this->writer['facebook'],
            'twitter'         => $this->writer['twitter'],
            'instagram'         => $this->writer['instagram'],
            'linkedin'         => $this->writer['linkedin'],
        ]);

    }
    
    public function render()
    {
        return view('livewire.pages.writer.update-writer-form');
    }
}
