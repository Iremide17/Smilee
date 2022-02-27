<?php

namespace App\Http\Livewire\Pages\Furniture;

use Livewire\Component;
use App\Models\Furniture;
use App\Models\Vendor;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $count = 8;
    public $searchTerm = '';
    public $type = '';
    public $vendor = '';
    public $minPrice = '';
    public $maxPrice = '';

    protected $queryString = [
        'type' => ['except' => '' ],
        'searchTerm' => ['except' => ''],
        'vendor' => ['except' => ''],
        'minPrice' => ['except' => ''],
        'maxPrice' => ['except' => ''],    
    ];

    public function loadMore()
    {
        $this->count += 3;
    }

    public function getFurnituresProperty()
    {
        return Furniture::when($this->type, function($query, $type) {
                    return $query->where('type', $type);
                })
                ->when($this->vendor, function($query, $vendor) {
                    $query->whereHas('vendor', function ($query) use ($vendor) {
                        $query->where('name', $vendor);
                    });
                })
                ->search(trim($this->searchTerm))
                ->loadLatest($this->count);
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function searchFurniture()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->reset();
    }

    public function render()
    {
        $types = ['old' => 'Old', 'new' => 'New'];

        return view('livewire.pages.furniture.index',[
            'furnitures' => $this->furnitures,
            'vendors' => Vendor::all()->pluck('name', 'id'),
            'types' => $types
        ]);
    }
}
