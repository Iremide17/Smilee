<?php

namespace App\Http\Livewire\Pages\Agent\Property;

use App\Models\Agent;
use App\Models\Property;
use Livewire\Component;

class Show extends Component
{
    public $agent;
    public $count = 3;
    public $searchTerm = null;
    public $type = null;
    public $sortBy = 'asc';
    public $orderBy = 'name';
    protected $queryString = ['type'];

    public function loadMore()
    {
        $this->count += 4;
    }

    public function mount(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function getPropertiesProperty()
    {
        return Property::where('agent_id', $this->agent->id)->where('available', true)->when($this->type, function($query, $type) {
            return $query->where('type', $type);
        })
        ->search(trim($this->searchTerm))->loadLatest($this->count, $this->orderBy, $this->sortBy);
    }

    public function clearSearchTermFilter()
    {
        $this->searchTerm = null;
    }

    public function clearSearchTypeFilter()
    {
        $this->type = null;
    }

    public function filterPropertybyType($type = null)
    {
        $this->resetPage();
        $this->type = $type;
    }

    public function render()
    {
        $mapProperties = $this->properties->makeHidden(['slug', 'type', 'category', 'room', 'year_built', 'price', 'created_at', 'updated_at', 'phone', 'email', 'instagram', 'facebook', 'twitter', 'linkedin']);
        $latitude = $this->properties->count() && (!is_null($this->type) || !is_null($this->searchTerm)) ? $this->properties->average('latitude') : 11.798;
        $longitude = $this->properties->count() && (!is_null($this->type) || !is_null($this->searchTerm)) ? $this->properties->average('longitude') : 13.125;

        return view('livewire.pages.agent.property.show',[
            'properties' => $this->properties,
            'mapProperties' => $mapProperties,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
 
}
