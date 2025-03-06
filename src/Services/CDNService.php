<?php

namespace PartiMate\CDNMate\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class CDNService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function upload($filePath, $fileName): ?string
    {
        $url = env("cdnmate.uploader_url", "http://127.0.0.3:80/media/detik-live-shopping/") . $fileName;

        try {
            $this->client->put($url, [
                'body' => fopen($filePath, 'r'),
                'headers' => ['User-Agent' => 'CDNMateUploader'],
            ]);

            return config('cdnmate.cdn_url') . $fileName;
        } catch (GuzzleException $e) {
            Log::info("Upload to CDN failed: " . $e->getMessage());

            if (config('cdnmate.fallback')) {
                return asset($filePath);
            }

            return null;
        }
    }
}
