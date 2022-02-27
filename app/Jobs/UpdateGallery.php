<?php

namespace App\Jobs;

use App\Models\Gallery;
use App\Services\SaveImageService;
use Illuminate\Support\Facades\File;
use App\Http\Requests\GalleryRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateGallery implements ShouldQueue
{
    use Dispatchable;

    private $gallery;
    private $name;
    private $description;
    private $image;


    public function __construct(
        Gallery $gallery,
        string $name,
        string $description,
        ?string $image
    )
    {
        $this->gallery = $gallery;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    public static function fromRequest(Gallery $gallery, GalleryRequest $request): self
    {
        return new static(
            $gallery,
            $request->name(),
            $request->description(),
            $request->image(),
        );
    }
    

    public function handle(): Gallery
    {
        $this->gallery->update([
            'name'                 => $this->name,
            'description'          => $this->description,
        ]);

        if (!is_null($this->image)) {

            File::delete(storage_path('app/public/' .$this->gallery->image()));
            SaveImageService::UploadImage($this->image, $this->gallery, Gallery::TABLE);
        }

        return $this->gallery;
    }
}
