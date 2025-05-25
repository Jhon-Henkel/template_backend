<?php

namespace App\Infra\Request;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin RequestToolsReal
 */
class RequestTools extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return RequestToolsReal::class;
    }
}
