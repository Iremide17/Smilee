<?php

namespace App\Jobs;

use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Services\SaveImageService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateGallery implements ShouldQueue
{
    use Dispatchable;

    private $name;
    private $description;
    private $image;
    
    public function __construct(
        string $name,
        string $description,
        ?string $image
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    public static function fromRequest(GalleryRequest $request): self
    {
        return new static(
            $request->name(),
            $request->description(),
            $request->image(),
        );
    }

    public function handle(): Gallery
    {
        $gallery = new Gallery([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        SaveImageService::UploadImage($this->image, $gallery, Gallery::TABLE);
        return $gallery;
        
    }
}
