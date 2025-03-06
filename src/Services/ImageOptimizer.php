<?php

namespace PartiMate\CDNMate\Services;

use Carbon\Carbon;
use Error;
use Intervention\Image\ImageManagerStatic as Image;
use Exception;
use Illuminate\Support\Facades\Log;

class ImageOptimizer
{
    public function extractFile($file, $aliases = null): array|string
    {
        if (!$file) {
            throw new Error('error file name is empty');
        }

        $extension = $file->getClientOriginalExtension();
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        $aliases = preg_replace('/[^A-Za-z0-9\-]/', '', $aliases);

        $name = str_replace(' ', '_', strtolower($name) . '_' . Carbon::now()->format('U') . '.' . $extension);

        $aliases = str_replace(' ', '_', strtolower($aliases) . '_' . Carbon::now()->format('U') . '.' . $extension);

        $filename = $aliases;
        if (empty($aliases)) {
            $filename = $name;
        }

        return $filename;
    }

    public function optimize($file, $filename, $compressionQuality = 80): ?string
    {
        try {
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