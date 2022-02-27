<?php

namespace App\Http\Livewire\Pages\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $count = 8;
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
        $this->count += 3;
    }

    public function getProductsProperty()
    {
        return Product::when($this->category, function($query, $category) {
            $query->whereHas('categoriesRelation', function ($query) use ($category) {
                $query->where('categories.slug', $category);
            });
        })
        ->when($this->type, function($query, $type) {
            return $query->where('type', $type);
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
        $types = ['old' => 'Old', 'new' => 'New'];
        $prices = ['0' => '0', '1000' => '1000', '2000' => '2000', '30000' => '30000', '50000' => '50000', '100000' => '100000'];

        return view('livewire.pages.product.index',[
            'products' => $this->products,
            'categories' => Category::all(),
            'prices'    => $prices,
            'types'      => $types
        ]);
    }
}
