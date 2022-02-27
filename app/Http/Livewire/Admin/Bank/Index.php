<?php

namespace App\Http\Livewire\Admin\Bank;

use App\Models\Bank;
use App\Models\Level;
use App\Models\Semester;
use Livewire\Component;

class Index extends Component
{

    public $selectedRows = [];
    public $selectPageRows = false;
    public $semester = '';
    public $level = '';
    public $per_page = 5;
    protected $queryString = [
        'level' => ['except' => ''],
        'semester' => ['except' => ''],
    ];

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->agents->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        }
        else{
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function getBanksProperty()
    {
        return Bank::when($this->level, function($query, $level) {
            $query->whereHas('levelsRelation', function ($query) use ($level) {
                $query->where('name', $level);
            });
        })
        ->when($this->semester, function($query, $semester) {
            $query->whereHas('semestersRelation', function ($query) use ($semester) {
                $query->where('name', $semester);
            });
        })
        ->latest()->paginate($this->per_page);
    }

    public function resetFilter()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.bank.index',[
            'banks'     => $this->banks,
            'semesters' => Semester::all(),
            'levels' => Level::all(),  
        ]);
    }
}
