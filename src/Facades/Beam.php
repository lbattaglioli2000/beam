<?php

namespace RayBeam\Beam\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RayBeam\Beam\Beam
 */
class Beam extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RayBeam\Beam\Beam::class;
    }
}
