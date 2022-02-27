<?php

namespace App\Http\Livewire\Pages\Agent;

use App\Models\Agent;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $count = 8;
    public $searchTerm = null;

    public function loadMore()
    {
        $this->count += 4;
    }

    public function clearSearchTermFilter()
    {
        $this->searchTerm = null;
    }
    
    public function getAgentsProperty()
    {
        return Agent::search(trim($this->searchTerm))
        ->where(function ($query){
            return $query->whereHas('status', function($query){
                $query->where('status_id', 4);
            });
        })
        ->loadLatest($this->count);
    }

    public function render()
    {
        return view('livewire.pages.agent.index',[
            'agents'     => $this->agents,
        ]);
    }
}
