<?php

namespace App\Http\Livewire\Admin\Vendor;

use App\Models\Status;
use App\Models\Vendor;
use Livewire\Component;
use App\Events\VendorBanned;
use Livewire\WithPagination;
use App\Events\VendorApplicationWasAccepted;
use App\Events\VendorApplicationWasRejected;

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

    public function getVendorsProperty()
    {
        return Vendor::when($this->status, function($query, $status) {
            $query->whereHas('status', function ($query) use ($status) {
                $query->where('name', $status);
            });
        })
        ->search(trim($this->searchTerm))
        ->latest()->paginate($this->per_page);
    }

    public function clearSearchTermFilter()
    {
        $this->searchTerm = null;
    }

    public function accept($Vendor)
    {
        $age = Vendor::findOrFail($Vendor);
        $age->update(['status_id' => 2]);
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Vendor accepted successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsAccept()
    {
        Vendor::whereIn('id', $this->selectedRows)->update(['status_id' => 2]);

        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents were marked as accepted']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function process($Vendor)
    {
        $age = Vendor::findOrFail($Vendor);
        $age->update(['status_id' => 3]);
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Vendor accepted successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsProcess()
    {
        Vendor::whereIn('id', $this->selectedRows)->update(['status_id' => 2]);
        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents 
            were marked as processed'
        ]);
        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function verify($Vendor)
    {
        $age = Vendor::findOrFail($Vendor);
        $age->update(['status_id' => 4]);
        event(new VendorApplicationWasAccepted($age));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Vendor verified successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsVerify()
    {
        Vendor::whereIn('id', $this->selectedRows)->update(['status_id' => 4]);

        $check = Vendor::whereIn('id', $this->selectedRows)->get();        

        for ($age = 0; $age < count($check); $age++) {
            event(new VendorApplicationWasAccepted($check[$age]));
        }
        
        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents 
            were marked as verified']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function reject($Vendor)
    {
        $age = Vendor::findOrFail($Vendor);
        $age->update(['status_id' => 5]);
        event(new VendorApplicationWasRejected($age));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Vendor rejected successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsReject()
    {
        Vendor::whereIn('id', $this->selectedRows)->update(['status_id' => 2]);

        $check = Vendor::whereIn('id', $this->selectedRows)->get();        

        for ($age = 0; $age < count($check); $age++) {
            event(new VendorApplicationWasRejected($check[$age]));
        }

        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents 
            were marked as rejectted']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function ban($Vendor)
    {
        $age = Vendor::findOrFail($Vendor);
        $age->update(['status_id' => 6]);
        event(new VendorBanned($age));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Vendor banned successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsBan()
    {
        Vendor::whereIn('id', $this->selectedRows)->update(['status_id' => 6]);

        $check = Vendor::whereIn('id', $this->selectedRows)->get();        

        for ($age = 0; $age < count($check); $age++) {
            event(new VendorBanned($check[$age]));
        }
        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents 
            were marked as banned']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function delete($Vendor)
    {
        $age = Vendor::findOrFail($Vendor);
        $age->delete();
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Vendor deleted successfully',
        ]);
        return redirect()->back();
    }

    public function deleteAll()
    {
        Vendor::whereIn('id', $this->selectedRows)->delete();

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
        return view('livewire.admin.vendor.index', [
            'vendors'     => $this->vendors,
            'agentsCount' => Vendor::count(),
            'statuses' => Status::all(),
        ]);
    }

}
