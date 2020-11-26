<?php

namespace Totaa\TotaaBfo;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Totaa\TotaaBfo\Skeleton\SkeletonClass
 */
class TotaaBfoFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'totaa-bfo';
    }
}
