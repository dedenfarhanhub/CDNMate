<?php

return [
    'cdn_url' => env('CDN_URL', 'http://127.0.0.3/media/'),
    'fallback' => env('CDN_FALLBACK', true),
    'image_path' => env('IMAGE_PATH', 'uploads/'),
];
