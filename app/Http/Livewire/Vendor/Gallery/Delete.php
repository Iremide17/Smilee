<?php

namespace App\Http\Livewire\Vendor\Gallery;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Delete extends Component
{

    use AuthorizesRequests;

    public $gallery;
    public $confirmingGalleryDeletion = false;

    public function confirmGalleryDeletion()
    {
        $this->resetErrorBag();
        $this->confirmingGalleryDeletion = true;
    }

    public function deleteGallery()
    {
        $this->gallery->delete();
        $this->dispatchBrowserEvent('success',['message' => 'Gallery Deleted successfully']);
        $this->mount();
    }
    
    public function render()
    {
        return view('livewire.vendor.gallery.delete');
    }
}
