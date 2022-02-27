<?php

namespace App\Jobs;

use App\Models\Status;
use App\Models\Product;
use App\Events\ProductWasCreated;
use App\Services\SaveImageService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Services\SaveImageServiceMultiple;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateProduct
{
    use Dispatchable;

    private $title;
    private $price;
    private $type;
    private $isCommentable;
    private $first;
    private $second;
    private $third;
    private $description;
    private $categories;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        string $title,
        string $price,
        string $type,
        bool $isCommentable,
        ?string $first,
        ?string $second,
        ?string $third,
        ?string $description,
        array $categories
    )
    {
        $this->title = $title;
        $this->price = $price;
        $this->type = $type;
        $this->isCommentable = $isCommentable;
        $this->first = $first;
        $this->second = $second;
        $this->third = $third;
        $this->description = $description;
        $this->categories = $categories;
    }

    public static function fromRequest(ProductRequest $request): self
    {
        return new static(
            $request->title(),
            $request->price(),
            $request->type(),
            $request->isCommentable(),
            $request->first(),
            $request->second(),
            $request->third(),
            $request->description(),
            $request->categories(),
        );
    }

    public function handle(): Product
    {
        $status = Status::whereName('Pending')->first();
        
        $product = new Product([
            'title'                 => $this->title,
            'price'                  => $this->price,
            'type'                  => $this->type,
            'description'           => $this->description,
            'description'           => $this->description,
            'is_commentable'        => $this->isCommentable ? false : true,
            'vendor_id'             => Auth::user()->vendor->id(),
            'status_id'             => $status->id()
        ]);

        $product->syncCategories($this->categories);
        
        SaveImageServiceMultiple::UploadBatch('image', $this->first, $product, Product::TABLE);
        SaveImageServiceMultiple::UploadBatch('image2', $this->second, $product, Product::TABLE);
        SaveImageServiceMultiple::UploadBatch('image3', $this->third, $product, Product::TABLE);

        // event(new ProductWasCreated($product));
        
        return $product;
    }
}
