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

    public function upload($filePath, $destination): ?string
    {
        $cdnUrl = config('cdnmate.cdn_url') . $destination . '/' . basename($filePath);

        try {
            $this->client->put($cdnUrl, [
                'body' => fopen($filePath, 'r'),
                'headers' => ['User-Agent' => 'CDNMateUploader'],
            ]);

            return $cdnUrl;
        } catch (GuzzleException $e) {
            Log::info("Upload to CDN failed: " . $e->getMessage());

            if (config('cdnmate.fallback')) {
                return asset($filePath);
            }

            return null;
        }
    }
}
