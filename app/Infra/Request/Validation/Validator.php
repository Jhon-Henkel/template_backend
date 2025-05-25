<?php

namespace App\Infra\Request\Validation;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin ValidatorReal
 */
class Validator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ValidatorReal::class;
    }
}
