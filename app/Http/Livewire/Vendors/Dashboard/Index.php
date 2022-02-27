<?php

namespace App\Http\Livewire\Vendors\Dashboard;

use Livewire\Component;
use App\Models\Category;
use App\Models\OrderDetail;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithFileUploads, WithPagination;

    public $image;
    public $categories;
    public $state = [];
    public $count = 4;
    public $code = '';
    public $type = '';

    protected $queryString = [
        'code' => ['except' => '' ],
        'type' => ['except' => '' ],
    ];

    public function loadMore()
    {
        $this->count += 4;
    }

    public function mount()
    {
        $this->state = Auth::user()->vendor->withoutRelations()->toArray();
        $this->categories  = Category::all();
    }

    public function updateVendorInformation()
    {
        $this->resetErrorBag();

        Auth::user()->vendor->update([

            $this->image ? array_merge($this->state, ['image' => $this->image]) : $this->state,

            'name'         => $this->state['name'],
            'phone'         => $this->state['phone'],
            'email'         => $this->state['email'],
            'description'         => $this->state['description'],
            'facebook'         => $this->state['facebook'],
            'twitter'         => $this->state['twitter'],
            'instagram'         => $this->state['instagram'],
            'linkedin'         => $this->state['linkedin'],
        ]);

        if ($this->state['categories']) {
           dd('yes');
        }

        $this->emit('updated');

        if (isset($this->image)) {
            $notification = array(
                'message' => 'Profile changed successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function getVendorProperty()
    {
        return Auth::user()->vendor;
    }

    public function render()
    {
        return view('livewire.vendors.dashboard.index',[
            'vendor' => $this->vendor,
            'selectedTags'  => old('tags', $this->vendor->categories()->pluck('id')->toArray()),
            'orders' => OrderDetail::when($this->code, function($query, $code) {
                $query->whereHas('order', function ($query) use ($code) {
                    $query->where('code', $code);
                    });
                })
            ->vendorOrders($this->count),
        ]);
    }
}
