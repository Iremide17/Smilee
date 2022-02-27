<?php

namespace App\Http\Livewire\Vendor\Furniture;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Delete extends Component
{

    use AuthorizesRequests;

    public $furniture;
    public $confirmingFurnitureDeletion = false;

    public function confirmFurnitureDeletion()
    {
        $this->resetErrorBag();
        $this->confirmingFurnitureDeletion = true;
    }

    public function deleteFurniture()
    {
        $this->furniture->delete();
        $this->dispatchBrowserEvent('success',['message' => 'Furniture Deleted successfully']);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.vendor.furniture.delete');
    }
}
