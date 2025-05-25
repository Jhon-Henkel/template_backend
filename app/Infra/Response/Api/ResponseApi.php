<?php

namespace App\Infra\Response\Api;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin ResponseApiReal
 */
class ResponseApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ResponseApiReal::class;
    }
}
