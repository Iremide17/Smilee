<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selectedRows = [];
    public $selectPageRows = false;
    public $per_page = 5;
    public $searchTerm = '';
    public $code = '';

    protected $queryString = [
        'searchTerm' => ['except' => ''],
        'code' => ['except' => ''],
    ];

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->orders->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        }
        else{
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function getOrdersProperty()
    {
        return Order::when($this->code, function($query, $code) {
            return $query->where('code', $code);
        })
        ->search(trim($this->searchTerm))
        ->loadLatest($this->per_page);
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function searchProperties()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.order.index',[
            'orders' => $this->orders,
        ]);
    }
}
