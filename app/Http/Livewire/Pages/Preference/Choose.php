<?php

namespace App\Http\Livewire\Pages\Preference;

use Livewire\Component;

class Choose extends Component
{

    public $showAgent = false;
    public $showVendor = false;
    public $showWriter = false;
    public $categories;

    public function addNew($type)
    {
        $this->reset();
        if ($type == 'agent') {
            $this->showAgent = true;
        }
        elseif ($type == 'vendor'){
            $this->showVendor = true;
        }
        elseif ($type == 'writer'){
            $this->showWriter = true;
        }
        $this->dispatchBrowserEvent('show-form');
    }
    
    public function render()
    {
        return view('livewire.pages.preference.choose');
    }
}
