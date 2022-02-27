<?php

namespace App\Jobs;

use App\Models\Property;
use App\Services\SaveVideoService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PropertyRequest;
use App\Services\SaveImageServiceMultiple;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateProperty
{
    use Dispatchable;

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
    private $image;
    private $image2;
    private $image3;
    private $video;
    private $description;
    private $fence;
    private $tiled;
    private $well;
    private $tap;
    private $toilet;
    private $available;
    
    public function __construct(
        string $name,
        string $type,
        int $room,
        string $yearBuilt,
        string $price,
        string $region,
        ?string $address,
        ?string $latitude,
        ?string $longitude,
        ?string $postalCode,
        ?string $image,
        ?string $image2,
        ?string $image3,
        ?string $video,
        string $description,
        bool $fence,
        bool $tiled,
        bool $well,
        bool $tap,
        bool $toilet,
        bool $available
    )
    {
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
        $this->image = $image;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->video = $video;
        $this->description = $description;
        $this->fence = $fence;
        $this->tiled = $tiled;
        $this->well = $well;
        $this->tap = $tap;
        $this->toilet = $toilet;
        $this->available = $available;
    }

    public static function fromRequest(PropertyRequest $request): self
    {
        return new static(
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
            $request->image(),
            $request->image2(),
            $request->image3(),
            $request->video(),
            $request->description(),
            $request->fence(),
            $request->tiled(),
            $request->well(),
            $request->tap(),
            $request->toilet(),
            $request->available()
        );
    }

    public function handle(): Property
    {
        $property = Property::create([
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
            'description'                  => $this->description,
            'fence'        => $this->fence ? true : false,
            'tiled'        => $this->tiled ? true : false,
            'well'        => $this->well ? true : false,
            'tap'        => $this->tap ? true : false,
            'toilet'        => $this->toilet ? true : false,
            'available'        => $this->available ? true : false,
            'agent_id'      => Auth::user()->agent->id(),
        ]);

        SaveImageServiceMultiple::UploadBatch('image', $this->image, $property, Property::TABLE);
        SaveImageServiceMultiple::UploadBatch('image_2', $this->image2, $property, Property::TABLE);
        SaveImageServiceMultiple::UploadBatch('image_3', $this->image3, $property, Property::TABLE);
        if ($this->video) {
            SaveVideoService::UploadVideo('video', $this->video, $property, Property::TABLE);
        }
        return $property;
    }
}
    