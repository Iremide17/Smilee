<?php

namespace App\Http\Livewire\Pages\Vendor;

use App\Models\Vendor;
use Livewire\Component;
use App\Jobs\LikeVendorJob;
use App\Jobs\UnlikeVendorJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Like extends Component
{
    use DispatchesJobs;

    public $vendor;

    public function mount(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function toggleLike()
    {
        if ($this->vendor->isLikedBy(Auth::user())) {
            $this->dispatchSync(new UnlikeVendorJob($this->vendor, Auth::user()));
            $this->dispatchBrowserEvent('alert', ['message' => 'You have successfully unliked this vendor']);
        } else {
            $this->dispatchSync(new LikeVendorJob($this->vendor, Auth::user()));
            $this->dispatchBrowserEvent('alert', ['message' => 'You have successfully liked this vendor']);
        }
    }
    
    public function render()
    {
        return view('livewire.pages.vendor.like');
    }
}
