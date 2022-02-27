<?php

namespace App\Jobs;

use App\Models\Property;
use App\Services\SaveVideoService;
use App\Services\SaveImageServiceMultiple;
use App\Http\Requests\StorePropertyRequest;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateProperty
{
    use Dispatchable;

    private $property;
    private $name;
    private $type;
    private $room;
    private $yearBuilt;
    private $price;
    private $region;
    private $address;
    private $latitude;
    private $longitude;
    private $postalCode;
    private $image1;
    private $image2;
    private $image3;
    private $video;
    private $status;
    private $description;
    private $fence;
    private $tiled;
    private $well;
    private $tap;
    private $toilet;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        Property $property,
        string $name,
        string $type,
        string $room,
        string $yearBuilt,
        string $price,
        string $region,
        ?string $address,
        ?string $latitude,
        ?string $longitude,
        ?string $postalCode,
        ?string $image1,
        ?string $image2,
        ?string $image3,
        ?string $video,
        string $status,
        string $description,
        bool $fence,
        bool $tiled,
        bool $well,
        bool $tap,
        bool $toilet
    )
    {
        $this->property = $property;
        $this->name = $name;
        $this->type = $type;
        $this->room = $room;
        $this->yearBuilt = $yearBuilt;
        $this->price = $price;
        $this->region = $region;
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->postalCode = $postalCode;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->video = $video;
        $this->status = $status;
        $this->description = $description;
        $this->fence = $fence;
        $this->tiled = $tiled;
        $this->well = $well;
        $this->tap = $tap;
        $this->toilet = $toilet;
    }

    public static function fromRequest(Property $property, StorePropertyRequest $request): self
    {
        return new static(
            $property,
            $request->name(),
            $request->type(),
            $request->room(),
            $request->yearBuilt(),
            $request->price(),
            $request->region(),
            $request->address(),
            $request->latitude(),
            $request->longitude(),
            $request->postalCode(),
            $request->image1(),
            $request->image2(),
            $request->image3(),
            $request->video(),
            $request->status(),
            $request->description(),
            $request->fence(),
            $request->tiled(),
            $request->well(),
            $request->tap(),
            $request->toilet(),
        );
    }

    public function handle(): Property
    {
        $this->property->update([
            'name'                 => $this->name,
            'type'                  => $this->type,
            'room'                  => $this->room,
            'year_built'     => $this->yearBuilt,
            'price'                 => $this->price,
            'region'                  => $this->region,
            'address'                  => $this->address,
            'latitude'                  => $this->latitude,
            'longitude'                  => $this->longitude,
            'postal_code'                  => $this->postalCode,
            'status'                  => $this->status,
            'description'                  => $this->description,
            'fence'        => $this->isCommentable ? false : true,
            'tiled'        => $this->isCommentable ? false : true,
            'well'        => $this->isCommentable ? false : true,
            'tap'        => $this->isCommentable ? false : true,
            'toilet'        => $this->isCommentable ? false : true,
        ]);

        if (!is_null($this->image1)) {
            SaveImageServiceMultiple::UploadImage($this->image1, 'image_1', $this->property, Property::TABLE);
        }
        if (!is_null($this->image2)) {
            SaveImageServiceMultiple::UploadImage($this->image2, 'image_2', $this->property, Property::TABLE);
        }
        if (!is_null($this->image3)) {
            SaveImageServiceMultiple::UploadImage($this->image3, 'image_3', $this->property, Property::TABLE);
        }
        if (!is_null($this->video)) {
            SaveVideoService::UploadImage($this->video, 'video', $this->property, Property::TABLE);
        }
        return $this->property;
    }
}
