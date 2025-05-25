<?php

namespace Tests\Unit\Infra\Response\Api;

use App\Infra\Response\Api\ResponseApiReal;
use App\Infra\Response\Enum\StatusCodeEnum;
use Mockery;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\UnitTestCase;

class ResponseApiRealUnitTest extends UnitTestCase
{
    #[TestDox("Testando com array no response do data")]
    public function testMakeDataTestOne()
    {
        $response = Mockery::mock(ResponseApiReal::class)->makePartial();
        $response->shouldAllowMockingProtectedMethods();

        $result = $response->makeData(['key' => 'value'], StatusCodeEnum::HttpAccepted);

        $this->assertEquals([
            'status' => StatusCodeEnum::HttpAccepted->value,
            'data' => ['key' => 'value'],
        ], $result);
    }

    #[TestDox("Testando com null no response do data")]
    public function testMakeDataTestTwo()
    {
        $response = Mockery::mock(ResponseApiReal::class)->makePartial();
        $response->shouldAllowMockingProtectedMethods();

        $result = $response->makeData(null, StatusCodeEnum::HttpAccepted);

        $this->assertEquals([
            'status' => StatusCodeEnum::HttpAccepted->value,
            'data' => null,
        ], $result);
    }

    #[TestDox("Testando com string no response do data")]
    public function testMakeDataTestThree()
    {
        $response = Mockery::mock(ResponseApiReal::class)->makePartial();
        $response->shouldAllowMockingProtectedMethods();

        $result = $response->makeData('teste', StatusCodeEnum::HttpAccepted);

        $this->assertEquals([
            'status' => StatusCodeEnum::HttpAccepted->value,
            'data' => 'teste',
        ], $result);
    }

    public function testRenderCreated()
    {
        $response = new ResponseApiReal();
        $result = $response->renderCreated();

        $this->assertEquals(StatusCodeEnum::HttpCreated->value, $result->getStatusCode());
        $this->assertEquals([
            'status' => StatusCodeEnum::HttpCreated->value,
            'data' => null,
        ], json_decode($result->getContent(), true));
    }

    public function testRenderOk()
    {
        $response = new ResponseApiReal();
        $result = $response->renderOk(['key' => 'value']);

        $this->assertEquals(StatusCodeEnum::HttpOk->value, $result->getStatusCode());
        $this->assertEquals([
            'status' => StatusCodeEnum::HttpOk->value,
            'data' => ['key' => 'value'],
        ], json_decode($result->getContent(), true));
    }

    public function testRenderNoContent()
    {
        $response = new ResponseApiReal();
        $result = $response->renderNoContent();

        $this->assertEquals(StatusCodeEnum::HttpNoContent->value, $result->getStatusCode());
        $this->assertEquals([
            'status' => StatusCodeEnum::HttpNoContent->value,
            'data' => null,
        ], json_decode($result->getContent(), true));
    }

    public function testRenderUnauthorized()
    {
        $response = new ResponseApiReal();
        $result = $response->renderUnauthorized();

        $this->assertEquals(StatusCodeEnum::HttpUnauthorized->value, $result->getStatusCode());
        $this->assertEquals([
            'status' => StatusCodeEnum::HttpUnauthorized->value,
            'data' => null,
        ], json_decode($result->getContent(), true));
    }

    public function testRenderNotFound()
    {
        $response = new ResponseApiReal();
        $result = $response->renderNotFount();

        $this->assertEquals(StatusCodeEnum::HttpNotFound->value, $result->getStatusCode());
        $this->assertEquals([
            'status' => StatusCodeEnum::HttpNotFound->value,
            'data' => 'Objeto não encontrado!',
        ], json_decode($result->getContent(), true));
    }

    public function testRenderBadRequest()
    {
        $response = new ResponseApiReal();
        $result = $response->renderBadRequest();

        $this->assertEquals(StatusCodeEnum::HttpBadRequest->value, $result->getStatusCode());
        $this->assertEquals([
            'status' => StatusCodeEnum::HttpBadRequest->value,
            'data' => null,
        ], json_decode($result->getContent(), true));
    }

    public function testRenderInternalServerError()
    {
        $response = new ResponseApiReal();
        $result = $response->renderInternalServerError('error');

        $this->assertEquals(StatusCodeEnum::HttpInternalServerError->value, $result->getStatusCode());
        $this->assertEquals([
            'status' => StatusCodeEnum::HttpInternalServerError->value,
            'data' => 'error',
        ], json_decode($result->getContent(), true));
    }
}
