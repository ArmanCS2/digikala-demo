<?php

namespace App\Http\Services\Image;



use Illuminate\Support\Facades\Config;

class ImageCacheService{
    public function cache($imagePath,$size='')
    {
        $imageSizes=Config::get('image.cache-image-sizes');

    }
}
