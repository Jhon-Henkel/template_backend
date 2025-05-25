<?php

namespace Tests\Unit\Infra\Route\Enum;

use App\Infra\Route\Enum\RouteNameEnum;
use Tests\UnitTestCase;

class RouteNameEnumUnitTest extends UnitTestCase
{
    public function testEnum()
    {
        $this->assertEquals('api.auth.login', RouteNameEnum::ApiAuthLogin->value);
    }
}
