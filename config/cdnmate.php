<?php

return [
    'uploader_url' => env('CDN_MATE_UPLOADER_URL', 'https://cdnmate.io'),
    'cdn_url' => env('CDN_MATE_URL', 'http://127.0.0.3/media/'),
    'fallback' => env('CDN_MATE_FALLBACK', true),
    'image_path' => env('IMAGE_MATE_PATH', 'uploads/'),
];
