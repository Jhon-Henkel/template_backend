<?php

namespace Tests\Unit\Infra\Response\Enum;

use App\Infra\Response\Enum\StatusCodeEnum;
use Tests\UnitTestCase;

class StatusCodeEnumUnitTest extends UnitTestCase
{
    public function testEnum()
    {
        $this->assertEquals(100, StatusCodeEnum::HttpContinue->value);
        $this->assertEquals(101, StatusCodeEnum::HttpSwitchingProtocols->value);
        $this->assertEquals(102, StatusCodeEnum::HttpProcessing->value);
        $this->assertEquals(103, StatusCodeEnum::HttpEarlyHints->value);
        $this->assertEquals(200, StatusCodeEnum::HttpOk->value);
        $this->assertEquals(201, StatusCodeEnum::HttpCreated->value);
        $this->assertEquals(202, StatusCodeEnum::HttpAccepted->value);
        $this->assertEquals(203, StatusCodeEnum::HttpNonAuthoritativeInformation->value);
        $this->assertEquals(204, StatusCodeEnum::HttpNoContent->value);
        $this->assertEquals(205, StatusCodeEnum::HttpResetContent->value);
        $this->assertEquals(206, StatusCodeEnum::HttpPartialContent->value);
        $this->assertEquals(207, StatusCodeEnum::HttpMultiStatus->value);
        $this->assertEquals(208, StatusCodeEnum::HttpAlreadyReported->value);
        $this->assertEquals(226, StatusCodeEnum::HttpImUsed->value);
        $this->assertEquals(300, StatusCodeEnum::HttpMultipleChoices->value);
        $this->assertEquals(301, StatusCodeEnum::HttpMovedPermanently->value);
        $this->assertEquals(302, StatusCodeEnum::HttpFound->value);
        $this->assertEquals(303, StatusCodeEnum::HttpSeeOther->value);
        $this->assertEquals(304, StatusCodeEnum::HttpNotModified->value);
        $this->assertEquals(305, StatusCodeEnum::HttpUseProxy->value);
        $this->assertEquals(306, StatusCodeEnum::HttpReserved->value);
        $this->assertEquals(307, StatusCodeEnum::HttpTemporaryRedirect->value);
        $this->assertEquals(308, StatusCodeEnum::HttpPermanentlyRedirect->value);
        $this->assertEquals(400, StatusCodeEnum::HttpBadRequest->value);
        $this->assertEquals(401, StatusCodeEnum::HttpUnauthorized->value);
        $this->assertEquals(402, StatusCodeEnum::HttpPaymentRequired->value);
        $this->assertEquals(403, StatusCodeEnum::HttpForbidden->value);
        $this->assertEquals(404, StatusCodeEnum::HttpNotFound->value);
        $this->assertEquals(405, StatusCodeEnum::HttpMethodNotAllowed->value);
        $this->assertEquals(406, StatusCodeEnum::HttpNotAcceptable->value);
        $this->assertEquals(407, StatusCodeEnum::HttpProxyAuthenticationRequired->value);
        $this->assertEquals(408, StatusCodeEnum::HttpRequestTimeout->value);
        $this->assertEquals(409, StatusCodeEnum::HttpConflict->value);
        $this->assertEquals(410, StatusCodeEnum::HttpGone->value);
        $this->assertEquals(411, StatusCodeEnum::HttpLengthRequired->value);
        $this->assertEquals(412, StatusCodeEnum::HttpPreconditionFailed->value);
        $this->assertEquals(413, StatusCodeEnum::HttpRequestEntityTooLarge->value);
        $this->assertEquals(414, StatusCodeEnum::HttpRequestUriTooLong->value);
        $this->assertEquals(415, StatusCodeEnum::HttpUnsupportedMediaType->value);
        $this->assertEquals(416, StatusCodeEnum::HttpRequestedRangeNotSatisfiable->value);
        $this->assertEquals(417, StatusCodeEnum::HttpExpectationFailed->value);
        $this->assertEquals(418, StatusCodeEnum::HttpIAmATeapot->value);
        $this->assertEquals(421, StatusCodeEnum::HttpMisdirectedRequest->value);
        $this->assertEquals(422, StatusCodeEnum::HttpUnprocessableEntity->value);
        $this->assertEquals(423, StatusCodeEnum::HttpLocked->value);
        $this->assertEquals(424, StatusCodeEnum::HttpFailedDependency->value);
        $this->assertEquals(425, StatusCodeEnum::HttpTooEarly->value);
        $this->assertEquals(426, StatusCodeEnum::HttpUpgradeRequired->value);
        $this->assertEquals(428, StatusCodeEnum::HttpPreconditionRequired->value);
        $this->assertEquals(429, StatusCodeEnum::HttpTooManyRequests->value);
        $this->assertEquals(431, StatusCodeEnum::HttpRequestHeaderFieldsTooLarge->value);
        $this->assertEquals(451, StatusCodeEnum::HttpUnavailableForLegalReasons->value);
        $this->assertEquals(500, StatusCodeEnum::HttpInternalServerError->value);
        $this->assertEquals(501, StatusCodeEnum::HttpNotImplemented->value);
        $this->assertEquals(502, StatusCodeEnum::HttpBadGateway->value);
        $this->assertEquals(503, StatusCodeEnum::HttpServiceUnavailable->value);
        $this->assertEquals(504, StatusCodeEnum::HttpGatewayTimeout->value);
        $this->assertEquals(505, StatusCodeEnum::HttpVersionNotSupported->value);
        $this->assertEquals(506, StatusCodeEnum::HttpVariantAlsoNegotiatesExperimental->value);
        $this->assertEquals(507, StatusCodeEnum::HttpInsufficientStorage->value);
        $this->assertEquals(508, StatusCodeEnum::HttpLoopDetected->value);
        $this->assertEquals(510, StatusCodeEnum::HttpNotExtended->value);
        $this->assertEquals(511, StatusCodeEnum::HttpNetworkAuthenticationRequired->value);
    }
}
