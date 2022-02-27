<?php

namespace App\Jobs;

use App\Models\Status;
use App\Models\Furniture;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FurnitureRequest;
use App\Services\SaveImageServiceMultiple;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateFurniture implements ShouldQueue
{
    use Dispatchable;

    private $title;
    private $price;
    private $categories;
    private $description;
    private $first;
    private $second;
    private $third;

    public function __construct(
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
        $this->title = $title;
        $this->price = $price;
        $this->type = $type;
        $this->categories = $categories;
        $this->description = $description;
        $this->first = $first;
        $this->second = $second;
        $this->third = $third;
    }


    public static function fromRequest(FurnitureRequest $request): self
    {
        return new static(
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

        $status = Status::whereName('Pending')->first();

        $furniture = new Furniture([
            'title'                 => $this->title,
            'price'                 => $this->price,
            'type'                 => $this->type,
            'description'          => $this->description,
            'vendor_id'             => Auth::user()->vendor->id(),
            'status_id'             => $status->id()
        ]);

        $furniture->syncCategories($this->categories);

        SaveImageServiceMultiple::UploadBatch('image', $this->first, $furniture, Furniture::TABLE);
        SaveImageServiceMultiple::UploadBatch('image2', $this->second, $furniture, Furniture::TABLE);
        SaveImageServiceMultiple::UploadBatch('image3', $this->third, $furniture, Furniture::TABLE);
        return $furniture;
    }
}
