<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Status;
use App\Models\Vendor;
use App\Services\SaveImageService;
use App\Http\Requests\VendorRequest;
use App\Services\SaveImageServiceMultiple;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class CreateVendor implements ShouldQueue
{
    use Dispatchable;

    private $name;
    private $phone;
    private $email;
    private $address;
    private $instagram;
    private $facebook;
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
        string $name,
        string $phone,
        string $email,
        string $address,
        string $instagram,
        string $facebook,
        ?string $image,
        ?string $banner,
        string $description,
        array $categories = [],
        User $author
    )
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->instagram = $instagram;
        $this->facebook = $facebook;
        $this->image = $image;
        $this->banner = $banner;
        $this->description = $description;
        $this->categories = $categories;
        $this->author = $author;
    }

    public static function fromRequest(VendorRequest $request): self
    {
        return new static(
            $request->name(),
            $request->phone(),
            $request->email(),
            $request->address(),
            $request->instagram(),
            $request->facebook(),
            $request->image(),
            $request->banner(),
            $request->description(),
            $request->categories(),
            $request->author(),
        );
    }

    public function handle(): Vendor
    {
        $vendor = new vendor([
            'name'                   => $this->name,
            'phone'                  => $this->phone,
            'email'                  => $this->email,
            'address'                => $this->address,
            'instagram'              => $this->instagram,
            'facebook'               => $this->facebook,
            'description'            => $this->description,
        ]);

        $status = Status::whereName('Pending')->first();
        $vendor->status()->associate($status);
        $vendor->useredBy($this->author);
        $vendor->syncCategories($this->categories);
        SaveImageService::UploadImage($this->image, $vendor, Vendor::TABLE);
        SaveImageServiceMultiple::UploadBatch('banner',$this->banner, $vendor, Vendor::TABLE);
        
        $vendor->user()->hasWallet('Vendor Wallet'); // bool(true)
        $wallet = $this->user->createWallet([
            'name' => 'Default Wallet',
            'slug' => 'default',
        ]);
        $vendor->user()->hasWallet('Vendor Wallet'); // bool(true)

        return $vendor;
    }
}
