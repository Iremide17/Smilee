<?php

namespace App\Http\Livewire\Vendor\Product;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Delete extends Component
{
    use AuthorizesRequests;

    public $product;
    public $confirmingProductDeletion = false;

    public function confirmProductDeletion()
    {
        $this->resetErrorBag();
        $this->confirmingProductDeletion = true;
    }

    public function deleteProduct()
    {
        $this->product->delete();
        $this->dispatchBrowserEvent('success',['message' => 'Product Deleted successfully']);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.vendor.product.delete');
    }
}
