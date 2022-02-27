<?php

namespace App\Http\Livewire\Admin\Writer;

use App\Models\Status;
use App\Models\Writer;
use Livewire\Component;
use App\Events\WriterBanned;
use Livewire\WithPagination;
use App\Events\VendorApplicationWasRejected;
use App\Events\WriterApplicationWasAccepted;
use App\Events\WriterApplicationWasRejected;
use App\Models\User;

class Index extends Component
{
    use WithPagination;

    public $selectedRows = [];
    public $selectPageRows = false;
    public $searchTerm = '';
    public $code = '';
    public $status = '';
    public $per_page = 5;
    protected $queryString = [
        'code' => ['except' => ''],
        'status' => ['except' => ''],
        'searchTerm' => ['except' => ''],
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

    public function getWritersProperty()
    {
        return Writer::when($this->status, function($query, $status) {
            $query->whereHas('status', function ($query) use ($status) {
                $query->where('name', $status);
            });
        })
        ->when($this->searchTerm, function($query, $searchTerm) {
            $query->whereHas('userRelation', function ($query) use ($searchTerm) {
                $query->where('name', $searchTerm);
            });
        })
        ->latest()->paginate($this->per_page);
    }

    public function accept($Writer)
    {
        $age = Writer::findOrFail($Writer);
        $age->update(['status_id' => 2]);
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Writer accepted successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsAccept()
    {
        Writer::whereIn('id', $this->selectedRows)->update(['status_id' => 2]);

        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents were marked as accepted']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function process($Writer)
    {
        $age = Writer::findOrFail($Writer);
        $age->update(['status_id' => 3]);
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Writer accepted successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsProcess()
    {
        Writer::whereIn('id', $this->selectedRows)->update(['status_id' => 2]);
        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents 
            were marked as processed'
        ]);
        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function verify($Writer)
    {
        $age = Writer::findOrFail($Writer);
        $age->update(['status_id' => 4]);
        event(new WriterApplicationWasAccepted($age));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Writer verified successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsVerify()
    {
        Writer::whereIn('id', $this->selectedRows)->update(['status_id' => 4]);

        $check = Writer::whereIn('id', $this->selectedRows)->get();        

        for ($age = 0; $age < count($check); $age++) {
            event(new WriterApplicationWasAccepted($check[$age]));
        }
        
        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents 
            were marked as verified']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function reject($Writer)
    {
        $age = Writer::findOrFail($Writer);
        $age->update(['status_id' => 5]);
        event(new WriterApplicationWasRejected($age));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Writer rejected successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsReject()
    {
        Writer::whereIn('id', $this->selectedRows)->update(['status_id' => 2]);

        $check = Writer::whereIn('id', $this->selectedRows)->get();        

        for ($age = 0; $age < count($check); $age++) {
            event(new VendorApplicationWasRejected($check[$age]));
        }

        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents 
            were marked as rejectted']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function ban($Writer)
    {
        $age = Writer::findOrFail($Writer);
        $age->update(['status_id' => 6]);
        event(new WriterBanned($age));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Writer banned successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsBan()
    {
        Writer::whereIn('id', $this->selectedRows)->update(['status_id' => 6]);

        $check = Writer::whereIn('id', $this->selectedRows)->get();        

        for ($age = 0; $age < count($check); $age++) {
            event(new WriterBanned($check[$age]));
        }
        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents 
            were marked as banned']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function delete($Writer)
    {
        $age = Writer::findOrFail($Writer);
        $age->delete();
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Writer deleted successfully',
        ]);
        return redirect()->back();
    }

    public function deleteAll()
    {
        Writer::whereIn('id', $this->selectedRows)->delete();

        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents 
            were deleted']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function resetFilter()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.writer.index', [
            'writers'     => $this->writers,
            'users'     => User::whereType(6)->get(),
            'agentsCount' => Writer::count(),
            'statuses' => Status::all(),
        ]);
    }
}
