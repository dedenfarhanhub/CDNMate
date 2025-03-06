<?php

namespace PartiMate\CDNMate;

use PartiMate\CDNMate\Services\CDNService;
use PartiMate\CDNMate\Services\ImageOptimizer;

class CDNMate
{
    protected CDNService $cdnService;
    protected ImageOptimizer $optimizer;

    public function __construct(CDNService $cdnService, ImageOptimizer $optimizer)
    {
        $this->cdnService = $cdnService;
        $this->optimizer = $optimizer;
    }

    public function upload($file, $path = 'uploads'): ?string
    {
        $optimized = $this->optimizer->optimize($file);
        return $this->cdnService->upload($optimized, $path);
    }
}