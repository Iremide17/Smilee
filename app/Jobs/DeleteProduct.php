<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\File;


class DeleteProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        if (!is_null($this->product->image)) {
            File::delete(storage_path('app/' . $this->product->image));
        }

        if (!is_null($this->product->image2)) {
            File::delete(storage_path('app/' . $this->product->image2));
        }

        if (!is_null($this->product->image3)) {
            File::delete(storage_path('app/' . $this->product->image3));
        }
        $this->product->delete();
    }
}
