<?php

namespace Tests\Unit\Infra\Request\Validation;

use App\Infra\Request\Validation\Exceptions\InvalidArrayDataException;
use App\Infra\Request\Validation\Exceptions\InvalidRequestDataException;
use App\Infra\Request\Validation\ValidatorReal;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\UnitTestCase;

class ValidatorRealUnitTest extends UnitTestCase
{
    #[TestDox("Testando com dados inválidos")]
    public function testValidateRequestTestOne()
    {
        $this->expectException(InvalidRequestDataException::class);
        $this->expectExceptionMessage("{\"Usuário\":[\"O Usuário é obrigatório!\"]}");

        $request = new Request();
        $request->merge(['userId' => '']);

        $validator = new ValidatorReal();
        $validator->validateRequest($request, ['userId' => 'required']);
    }

    #[TestDox("Testando com dados válidos")]
    public function testValidateRequestTestTwo()
    {
        $request = new Request();
        $request->merge(['name' => 'Test']);

        $validator = new ValidatorReal();
        $validator->validateRequest($request, ['name' => 'required']);

        $this->assertTrue(true);
    }

    #[TestDox("Testando com dados inválidos")]
    public function testValidateArrayDataTestOne()
    {
        $this->expectException(InvalidArrayDataException::class);
        $this->expectExceptionMessage("{\"Usuário\":[\"O Usuário é obrigatório!\"]}");

        $array = ['userId' => ''];

        $validator = new ValidatorReal();
        $validator->validateArrayData($array, ['userId' => 'required']);
    }

    #[TestDox("Testando com dados válidos")]
    public function testValidateArrayDataTestTwo()
    {
        $array = ['name' => 'Test'];

        $validator = new ValidatorReal();
        $validator->validateArrayData($array, ['name' => 'required']);

        $this->assertTrue(true);
    }
}
