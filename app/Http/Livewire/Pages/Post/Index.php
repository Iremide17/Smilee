<?php

namespace App\Http\Livewire\Pages\Post;

use App\Models\Post;
use Livewire\Component;
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
        $this->count += 4;
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
        $types = ['standard' => 'standard', 'premium' => 'premium'];

        return view('livewire.pages.post.index',[
            'posts' => Post::when($this->type, function($query, $type) {
                return $query->where('type', $type);
            })
            ->search(trim($this->searchTerm))
            ->loadLatest($this->count),
            'types' => $types
        ]);
    }
}
