<?php

namespace Credpal\CPInvest\Facade;

use Illuminate\Support\Facades\Facade;

class CpInvest extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'cpinvest';
    }
}
