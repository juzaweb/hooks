<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://cms.juzaweb.com
 */

namespace Juzaweb\Hooks\Facades;

use Illuminate\Support\Facades\Facade;
use Juzaweb\Hooks\Contracts\Hook as HookContract;

class Hook extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return HookContract::class;
    }
}
