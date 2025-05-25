<?php

namespace App\Infra\Response;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin ResponseToolsReal
 */
class ResponseTools extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ResponseToolsReal::class;
    }
}
