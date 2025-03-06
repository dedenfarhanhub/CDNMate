<?php

namespace PartiMate\CDNMate\Facades;

use Illuminate\Support\Facades\Facade;
class CDNMate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cdnmate';
    }
}