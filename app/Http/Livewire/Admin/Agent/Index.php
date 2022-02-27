<?php

namespace App\Http\Livewire\Admin\Agent;

use App\Models\Agent;
use App\Models\Status;
use Livewire\Component;
use App\Jobs\DeleteAgent;
use App\Events\AgentBanned;
use App\Policies\UserPolicy;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Events\ApplicationWasAccepted;
use App\Events\ApplicationWasRejected;

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

    public function getAgentsProperty()
    {
        return Agent::when($this->status, function($query, $status) {
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

    public function accept($agent)
    {
        $age = Agent::findOrFail($agent);
        $age->update(['status_id' => 2]);
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Agent accepted successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsAccept()
    {
        Agent::whereIn('id', $this->selectedRows)->update(['status_id' => 2]);

        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents were marked as accepted']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function process($agent)
    {
        $age = Agent::findOrFail($agent);
        $age->update(['status_id' => 3]);
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Agent accepted successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsProcess()
    {
        Agent::whereIn('id', $this->selectedRows)->update(['status_id' => 2]);
        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents
            were marked as processed'
        ]);
        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function verify($agent)
    {
        $age = Agent::findOrFail($agent);
        $age->update(['status_id' => 4]);
        event(new ApplicationWasAccepted($age));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Agent verified successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsVerify()
    {
        Agent::whereIn('id', $this->selectedRows)->update(['status_id' => 4]);
        $check = Agent::whereIn('id', $this->selectedRows)->get();

        for ($age = 0; $age < count($check); $age++) {
            event(new ApplicationWasAccepted($check[$age]));
        }

        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents
            were marked as verified']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function reject($agent)
    {
        $age = Agent::findOrFail($agent);
        $age->update(['status_id' => 5]);
        event(new ApplicationWasRejected($age));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Agent rejected successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsReject()
    {
        Agent::whereIn('id', $this->selectedRows)->update(['status_id' => 2]);

        $check = Agent::whereIn('id', $this->selectedRows)->get();

        for ($age = 0; $age < count($check); $age++) {
            event(new ApplicationWasRejected($check[$age]));
        }

        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents
            were marked as rejectted']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function ban($agent)
    {
        $age = Agent::findOrFail($agent);
        $age->update(['status_id' => 6]);
        event(new AgentBanned($age));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Agent banned successfully',
        ]);
        return redirect()->back();
    }

    public function markAllAsBan()
    {
        Agent::whereIn('id', $this->selectedRows)->update(['status_id' => 6]);

        $check = Agent::whereIn('id', $this->selectedRows)->get();

        for ($age = 0; $age < count($check); $age++) {
            event(new AgentBanned($check[$age]));
        }
        $this->dispatchBrowserEvent('alert', ['message' => 'All selected agents
            were marked as banned']);

        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function delete($agent)
    {
        $age = Agent::findOrFail($agent);
        $this->dispatchSync(new DeleteAgent($age));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Agent deleted successfully',
        ]);
        return redirect()->back();
    }

    public function deleteAll()
    {
        Agent::whereIn('id', $this->selectedRows)->delete();

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
        return view('livewire.admin.agent.index', [
            'agents'     => $this->agents,
            'agentsCount' => Agent::count(),
            'statuses' => Status::pluck('name'),
        ]);
    }
}
