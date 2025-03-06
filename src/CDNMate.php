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

    public function upload($file, $compressionQuality = 80): ?string
    {
        $fileName = $this->optimizer->extractFile($file, date('YmdHis'));
        $optimizedPath = $this->optimizer->optimize($file, $fileName, $compressionQuality);
        return $this->cdnService->upload($optimizedPath, $fileName);
    }
}