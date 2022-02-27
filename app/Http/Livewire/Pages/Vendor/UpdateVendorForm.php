<?php

namespace App\Http\Livewire\Pages\Vendor;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UpdateVendorForm extends Component
{
    public User $user;
    public $vendor = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->vendor = Auth::user()->vendor->toArray();
    }

    public function updateSocialLink()
    {
        $this->user->vendor()->update([

            'name'          => $this->vendor['name'],
            'phone'         => $this->vendor['phone'],
            'email'         => $this->vendor['email'],
            'address'           => $this->vendor['address'],
            'facebook'         => $this->vendor['facebook'],
            'twitter'         => $this->vendor['twitter'],
            'instagram'         => $this->vendor['instagram'],
            'linkedin'         => $this->vendor['linkedin'],
            'description'           => $this->vendor['description'],
        ]);

    }

    public function render()
    {
        return view('livewire.pages.vendor.update-vendor-form');
    }
}
