<?php

namespace App\Jobs;

use App\Models\House;
use App\Services\SaveVideoService;
use App\Http\Requests\HouseRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\SaveImageServiceMultiple;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateHouse
{
    use Dispatchable;

    private $name;
    private $type;
    private $category;
    private $room;
    private $yearBuilt;
    private $price;
    private $region;
    private $address;
    private $latitude;
    private $longitude;
    private $postalCode;
    private $status;
    private $description;
    private $fence;
    private $tiled;
    private $well;
    private $tap;
    private $toilet;
    
    public function __construct(
        string $name,
        string $type,
        string $category,
        string $room,
        string $yearBuilt,
        string $price,
        string $region,
        ?string $address,
        ?string $latitude,
        ?string $longitude,
        ?string $postalCode,
        string $status,
        string $description,
        bool $fence,
        bool $tiled,
        bool $well,
        bool $tap,
        bool $toilet
    )
    {
        $this->name = $name;
        $this->type = $type;
        $this->category = $category;
        $this->room = $room;
        $this->yearBuilt = $yearBuilt;
        $this->price = $price;
        $this->region = $region;
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->postalCode = $postalCode;
        $this->status = $status;
        $this->description = $description;
        $this->fence = $fence;
        $this->tiled = $tiled;
        $this->well = $well;
        $this->tap = $tap;
        $this->toilet = $toilet;
    }

    public static function fromRequest(HouseRequest $request): self
    {
        return new static(
            $request->name(),
            $request->type(),
            $request->category(),
            $request->room(),
            $request->yearBuilt(),
            $request->price(),
            $request->region(),
            $request->address(),
            $request->latitude(),
            $request->longitude(),
            $request->postalCode(),
            $request->status(),
            $request->description(),
            $request->fence(),
            $request->tiled(),
            $request->well(),
            $request->tap(),
            $request->toilet()
        );
    }

    public function handle(): House
    {
        $house = new House([
            'name'                 => $this->name,
            'type'                  => $this->type,
            'category'                  => $this->category,
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
            'fence'        => $this->fence ? false : true,
            'tiled'        => $this->tiled ? false : true,
            'well'        => $this->well ? false : true,
            'tap'        => $this->tap ? false : true,
            'toilet'        => $this->toilet ? false : true,
        ]);

        $house->agent_id = Auth::user()->agent->id();        
        return $house;
    }
}
