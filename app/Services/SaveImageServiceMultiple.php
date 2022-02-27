<?php

namespace App\Services;

use Illuminate\Http\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SaveImageServiceMultiple
{
    public static function UploadBatch($row, $image, $model, $folder)
    {
        $path = Storage::putFile('public/' .$folder, new File($image));
        $storagePath = storage_path('app/'. $path);
        Image::make($image)->resize(1200, 650)->save($storagePath);
        $model->$row = $path;
        $model->save();
    }
}

