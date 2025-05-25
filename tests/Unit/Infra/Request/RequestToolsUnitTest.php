<?php

namespace Tests\Unit\Infra\Request;

use App\Infra\Request\RequestTools;
use Tests\UnitTestCase;

class RequestToolsUnitTest extends UnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        unset($_POST['abc']);
        unset($_GET['jkl']);
    }

    protected function tearDown(): void
    {
        unset($_POST['abc']);
        unset($_GET['jkl']);
        parent::tearDown();
    }

    public function testGetUserIp()
    {
        $_SERVER['REMOTE_ADDR'] = '192.155.33.22';

        $this->assertEquals('192.155.33.22', RequestTools::getUserIp());

        $_SERVER['HTTP_X_FORWARDED_FOR'] = '192.155.33.23';

        $this->assertEquals('192.155.33.23', RequestTools::getUserIp());
    }

    public function testGetUserAgent()
    {
        $_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)';

        $this->assertEquals('Mozilla/5.0 (Windows NT 10.0; Win64; x64)', RequestTools::getUserAgent());
    }

    public function testIsApplicationInDevelopMode()
    {
        $this->assertTrue(RequestTools::isApplicationInDevelopMode());

        config()->set('app.env', 'production');

        $this->assertFalse(RequestTools::isApplicationInDevelopMode());
    }
}
