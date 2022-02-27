<?php

namespace App\Events;

use App\Models\Gallery;
use Illuminate\Queue\SerializesModels;

class GalleryWasCreated
{
    use SerializesModels;

    public $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }
}
