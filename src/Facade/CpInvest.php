<?php

namespace Credpal\CPInvest\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed getAdminConfiguration()
 * @method static mixed updateAdminConfiguration(string $key, array $data)
 * @method static mixed getAllInvestments()
 *
 * @see \CredPal\CPInvest\CPInvest
 */
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
