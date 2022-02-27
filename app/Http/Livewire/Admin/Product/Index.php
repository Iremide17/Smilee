<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Status;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $selectedRows = [];
    public $selectPageRows = false;
    public $per_page = 5;
    public $searchTerm = '';
    public $type = '';
    public $category = '';
    public $status = '';
    public $code = '';

    protected $queryString = [
        'type' => ['except' => '' ],
        'searchTerm' => ['except' => ''],
        'category' => ['except' => ''],
        'code' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->products->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        }
        else{
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function filterProductByType($type = null)
    {
        $this->resetPage();
        $this->type = $type;
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
        ->when($this->status, function($query, $status) {
            $query->whereHas('status', function ($query) use ($status) {
                $query->where('name', $status);
            });
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

    public function filterProductByStatus($status = null)
    {
        $this->resetPage();
        $this->status = $status;
    }

    public function resetFilter()
    {
        $this->reset();
    }

    public function render()
    {
        $types = ['old' => 'Old', 'new' => 'New'];
        $prices = ['0' => '0', '1000' => '1000', '2000' => '2000', '30000' => '30000', '50000' => '50000', '100000' => '100000'];
        $productsCount = Product::count();
        $pendingProductscount = Product::where('status_id', 1)->count();
        $processProductsCount = Product::where('status_id', 2)->count();
        $acceptedProductsCount = Product::where('status_id', 3)->count();
        $verifiedProductsCount = Product::where('status_id', 4)->count();
        $rejectedProductsCount = Product::where('status_id', 5)->count();

        return view('livewire.admin.product.index',[
            'products' => $this->products,
            'categories' => Category::all(),
            'statuses' => Status::pluck('name'),
            'prices'    => $prices,
            'types'      => $types,
            'productsCount' => $productsCount,
            'pendingProductscount' => $pendingProductscount,
            'processProductsCount' => $processProductsCount,
            'acceptedProductsCount' => $acceptedProductsCount,
            'verifiedProductsCount' => $verifiedProductsCount,
            'rejectedProductsCount' => $rejectedProductsCount,
        ]);
    }
}
