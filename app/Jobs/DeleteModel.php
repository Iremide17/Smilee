<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;


class DeleteModel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function handle()
    {
        if (!is_null($this->model->image)) {
            File::delete(storage_path('app/' . $this->model->image));
        }

        if (!is_null($this->model->image2)) {
            File::delete(storage_path('app/' . $this->model->image2));
        }

        if (!is_null($this->model->image3)) {
            File::delete(storage_path('app/' . $this->model->image3));
        }
        $this->model->delete();
    }
}
