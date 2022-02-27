<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Post;
use App\Models\Vendor;
use App\Models\Writer;
use App\Models\Product;
use Livewire\Component;
use App\Jobs\DeleteModel;
use App\Services\SaveCode;
use App\Models\OrderDetail;
use App\Services\SaveCodeService;

class Status extends Component
{
    public $model;
    public $page;

    public function mount($page)
    {
        $this->page = $page;
    }

    public function process($id)
    {
        $mode = get_class($this->model);

        if ($mode == 'Post') {
            $post = Post::find($id);
            $post->update(['status_id' => 2]);
        }
        elseif ($mode == 'Writer') {
            $writer = Writer::find($id);
            $writer->update(['status_id' => 2]);
        }
        elseif ($mode == 'Vendor') {
            $vendor = Vendor::find($id);
            $vendor->update(['status_id' => 2]);
        }
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Process successfull',
        ]);
        return redirect()->back();
    }

    public function accept($id)
    {
        $mode = class_basename($this->model);

        $this->model->update(['status_id' => 4]);

        if ($mode == 'OrderDetail') {
            
            SaveCode::Generator(new OrderDetail,$this->model, 'tracking_code');
        }

        $this->dispatchBrowserEvent('alert', [
            'message'     => $mode.' accetpted successfully',
        ]);

        return redirect()->to($this->page);
    }

    public function delete($id)
    {
        $mode = class_basename($this->model);
        
        DeleteModel::dispatch($this->model);

        $this->dispatchBrowserEvent('alert', [
            'message'     => $mode. ' deleted successfully',
        ]);

        return redirect()->to($this->page);
    }

    public function render()
    {
        return view('livewire.admin.setting.status');
    }
}

