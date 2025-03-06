<?php

namespace PartiMate\CDNMate\Services;

use Intervention\Image\ImageManagerStatic as Image;
use Exception;
use Illuminate\Support\Facades\Log;

class ImageOptimizer
{
    public function optimize($file, $compressionQuality = 80): ?string
    {
        try {
            $filename = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $path = config('cdnmate.image_path') . $filename;

            $image = Image::make($file);
            $width = $image->width() * 99 / 100;
            $height = $image->height() * 99 / 100;
            $image->resize($width, $height);

            if($compressionQuality < 100){
                $image->save($path, $compressionQuality);
            }else{
                $image->save($path);
            }

            return $path;
        } catch (Exception $e) {
            Log::info("Image compression failed: " . $e->getMessage());
            return null;
        }
    }
}