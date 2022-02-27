<?php

namespace App\Jobs;

use App\Models\Product;
use App\Services\SaveImageService;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Services\SaveImageServiceMultiple;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateProduct
{
    use Dispatchable;

    private $product;
    private $title;
    private $price;
    private $seller;
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
        Product $product,
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
        $this->product = $product;
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

    public static function fromRequest(Product $product, ProductRequest $request): self
    {
        return new static(
            $product,
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
        $this->product->update([
            'title'                 => $this->title,
            'price'                  => $this->price,
            'type'                  => $this->type,
            'is_commentable'        => $this->isCommentable ? false : true,
            'description'           => $this->description,
        ]);

        $this->product->syncCategories($this->categories);

        if (!is_null($this->first)) {

            File::delete(storage_path('app/public/' .$this->product->image));
            SaveImageServiceMultiple::UploadBatch('image', $this->first, $this->product, Product::TABLE);
        }
        if (!is_null($this->second)) {

            File::delete(storage_path('app/public/' .$this->product->image2));
            SaveImageServiceMultiple::UploadBatch('image2', $this->second, $this->product, Product::TABLE);
        }
        if (!is_null($this->third)) {

            File::delete(storage_path('app/public/' .$this->product->image3));
            SaveImageServiceMultiple::UploadBatch('image3', $this->third, $this->product, Product::TABLE);
        }
        return $this->product;
    }
}
