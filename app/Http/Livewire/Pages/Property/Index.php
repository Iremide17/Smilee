<?php

namespace App\Http\Livewire\Pages\Property;

use Livewire\Component;
use App\Models\Property;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $count = 4;
    public $searchTerm = '';
    public $type = '';
    public $category = '';
    public $minPrice = '';
    public $maxPrice = '';

    protected $queryString = [
        'type' => ['except' => '' ],
        'searchTerm' => ['except' => ''],
        'category' => ['except' => ''],
        'minPrice' => ['except' => ''],
        'maxPrice' => ['except' => ''],
    ];

    public function loadMore()
    {
        $this->count += 4;
    }

    public function getPropertiesProperty()
    {
        return Property::when($this->type, function($query, $type) {
            return $query->where('type', $type);
        })
        ->when($this->category, function($query) {
            $query->where('category',$this->category);
        })
        ->when($this->minPrice, function($query) {
            $query->whereBetween('price', [$this->minPrice,$this->maxPrice]);
        })
        ->where(function ($query){
            return $query->whereHas('status', function($query){
                $query->where('status_id', 4);
            });
        })
        ->search(trim($this->searchTerm))
        ->loadLatest($this->count);
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
        $categories = ['sc' => 'Self Contain', 'ar' => 'Single Room', 'f' => 'Flat'];
        $types = ['rent' => 'Rent', 'sale' => 'Sale'];
        $prices = ['0' => '0', '1000' => '1000', '2000' => '2000', '30000' => '30000', '50000' => '50000', '100000' => '100000'];

        return view('livewire.pages.property.index',[
            'properties'     => $this->properties,
            'categories' => $categories,
            'prices'    => $prices,
            'types'      => $types
        ]);
    }
}
