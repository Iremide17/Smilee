<?php

namespace App\Http\Livewire\Pages\Vendor;

use App\Models\Vendor;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchTerm;
    public $category = null;
    protected $queryString = ['category'];
    public $count = 4;

    public function loadMore()
    {
        $this->count += 4;
    }

    public function getVendorsProperty()
    {
        return Vendor::when($this->category, function($query, $category) {
                        $query->whereHas('categoriesRelation', function ($query) use ($category) {
                            $query->where('categories.slug', $category);
                        })->where(function ($query){
                            return $query->whereHas('status', function($query){
                                $query->where('status_id', 4);
                            });
                        });
        })
        ->search(trim($this->searchTerm))
        ->loadLatest($this->count);
    }

    public function clearSearchTermFilter()
    {
        $this->searchTerm = null;
    }

    public function clearCategoryFilter()
    {
        $this->category = null;
    }
    public function render()
    {
        $mapVendors = $this->vendors->makeHidden(['created_at', 'updated_at', 'phone', 'email', 'instagram', 'facebook', 'twitter', 'linkedin']);
        $latitude = $this->vendors->count() && (!is_null($this->category) || !is_null($this->searchTerm)) ? $this->vendors->average('latitude') : 11.798;
        $longitude = $this->vendors->count() && (!is_null($this->category) || !is_null($this->searchTerm)) ? $this->vendors->average('longitude') : 13.125;
        return view('livewire.pages.vendor.index',[
            'vendors'       => $this->vendors,
            'categories' => Category::all(),
            'mapVendors' => $mapVendors,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}
