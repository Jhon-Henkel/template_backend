<?php

namespace Tests\Unit\Infra\Enum;

use App\Infra\Enum\GatesAbilityEnum;
use Tests\UnitTestCase;

class GatesAbilityEnumUnitTest extends UnitTestCase
{
    public function testEnum()
    {
        $this->assertEquals('create', GatesAbilityEnum::Create->value);
        $this->assertEquals('list', GatesAbilityEnum::List->value);
        $this->assertEquals('get', GatesAbilityEnum::Get->value);
        $this->assertEquals('update', GatesAbilityEnum::Update->value);
        $this->assertEquals('delete', GatesAbilityEnum::Delete->value);
    }
}
