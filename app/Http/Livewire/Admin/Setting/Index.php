<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use App\Models\Application;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public Application $application;
    public $app = [];
    public $photo;

    public function mount()
    {
        $this->application = Application::first();
        $this->app = Application::first()->toArray();
    }

    public function updateApplicationInformation()
    {

        $this->application->update([
            'name'         => $this->app['name'],
            'alias'         => $this->app['alias'],
            'email'         => $this->app['email'],
            'line1'         => $this->app['line1'],
            'line2'         => $this->app['line2'],
            'slogan'         => $this->app['slogan'],
            'motto'         => $this->app['motto'],
            'whatsapp'         => $this->app['whatsapp'],
            'facebook'         => $this->app['facebook'],
            'instagram'         => $this->app['instagram'],
            'address'         => $this->app['address'],
            'description'         => $this->app['description'],
            'terms'         => $this->app['terms'],
            'policy'         => $this->app['policy'],
        ]);

        if (isset($this->photo)) {
            File::delete(storage_path('app/' .$this->application->image));
            $this->application->update(['image' => $this->photo->store('applications', 'public')]);
            return redirect()->route('admin.setting.index');
        }

        $this->emit('saved');

        $this->emit('refresh-navigation-menu');

    }

    public function deleteApplicationPhoto()
    {
        Application::first()->update([
            'image' => null,
        ]);

        $this->emit('refresh-navigation-menu');
    }
    
    public function render()
    {
        return view('livewire.admin.setting.index');
    }
}
