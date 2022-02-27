<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Vendor;
use App\Services\SaveImageService;
use App\Http\Requests\VendorRequest;
use Illuminate\Support\Facades\File;
use App\Services\SaveImageServiceMultiple;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Requests\UpdateVendor as RequestsUpdateVendor;

class UpdateVendor
{
    use Dispatchable;
    private $vendor;
    private $name;
    private $phone;
    private $email;
    private $address;
    private $instagram;
    private $facebook;
    private $twitter;
    private $linkedin;
    private $image;
    private $banner;
    private $description;
    private $categories;
    private $author;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        Vendor $vendor,
        string $name,
        string $phone,
        string $email,
        ?string $address,
        ?string $instagram,
        ?string $facebook,
        ?string $twitter,
        ?string $linkedin,
        ?string $image,
        ?string $banner,
        string $description,
        array $categories = [],
        User $author
    )
    {
        $this->vendor = $vendor;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->instagram = $instagram;
        $this->facebook = $facebook;
        $this->twitter = $twitter;
        $this->linkedin = $linkedin;
        $this->image = $image;
        $this->banner = $banner;
        $this->description = $description;
        $this->categories = $categories;
        $this->author = $author;
    }

    public static function fromRequest(Vendor $vendor, RequestsUpdateVendor $request): self
    {
        return new static(
            $vendor,
            $request->name(),
            $request->phone(),
            $request->email(),
            $request->address(),
            $request->instagram(),
            $request->facebook(),
            $request->twitter(),
            $request->linkedin(),
            $request->image(),
            $request->banner(),
            $request->description(),
            $request->categories(),
            $request->author(),
        );
    }

    public function handle(): Vendor
    {
        $this->vendor->update([
            'name'                   => $this->name,
            'phone'                  => $this->phone,
            'email'                  => $this->email,
            'address'                => $this->address,
            'instagram'              => $this->instagram,
            'facebook'               => $this->facebook,
            'twitter'               => $this->twitter,
            'linkedin'              => $this->linkedin,
            'description'            => $this->description,
        ]);

        $this->vendor->useredBy($this->author);
        $this->vendor->syncCategories($this->categories);

        if (!is_null($this->image)) {
            File::delete(storage_path('app/public/' .$this->vendor->image));
            SaveImageServiceMultiple::UploadBatch('image',$this->image, $this->vendor, Vendor::TABLE);
        }

        if (!is_null($this->banner)) {
            File::delete(storage_path('app/public/' .$this->vendor->banner));
            SaveImageServiceMultiple::UploadBatch('banner',$this->banner, $this->vendor, Vendor::TABLE);
        }

        return $this->vendor;
    }
}
