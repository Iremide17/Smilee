<?php

namespace App\Jobs;

use App\Models\Furniture;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use App\Http\Requests\FurnitureRequest;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\SaveImageServiceMultiple;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateFurniture implements ShouldQueue
{
    use Dispatchable;

    private $furniture;
    private $title;
    private $price;
    private $categories;
    private $description;
    private $first;
    private $second;
    private $third;

   
    public function __construct(
        Furniture $furniture,
        string $title,
        string $price,
        string $type,
        array $categories,
        string $description,
        ?string $first,
        ?string $second,
        ?string $third
    )
    {
        $this->furniture = $furniture;
        $this->title = $title;
        $this->price = $price;
        $this->type = $type;
        $this->categories = $categories;
        $this->description = $description;
        $this->first = $first;
        $this->second = $second;
        $this->third = $third;
    }

    public static function fromRequest(Furniture $furniture, FurnitureRequest $request): self
    {
        return new static(
            $furniture,
            $request->title(),
            $request->price(),
            $request->type(),
            $request->categories(),
            $request->description(),
            $request->first(),
            $request->second(),
            $request->third(),
        );
    }
    
    public function handle(): Furniture
    {
        $this->furniture->update([
            'title'                 => $this->title,
            'price'                 => $this->price,
            'type'                 => $this->type,
            'description'          => $this->description,
        ]);

        $this->furniture->syncCategories($this->categories);

        if (!is_null($this->first)) {

            File::delete(storage_path('app/public/' .$this->furniture->image));
            SaveImageServiceMultiple::UploadBatch('image', $this->first, $this->furniture, Furniture::TABLE);
        }
        if (!is_null($this->second)) {

            File::delete(storage_path('app/public/' .$this->furniture->image2));
            SaveImageServiceMultiple::UploadBatch('image2', $this->second, $this->furniture, Furniture::TABLE);
        }
        if (!is_null($this->third)) {

            File::delete(storage_path('app/public/' .$this->furniture->image3));
            SaveImageServiceMultiple::UploadBatch('image3', $this->third, $this->furniture, Furniture::TABLE);
        }
        return $this->furniture;
    }
}
