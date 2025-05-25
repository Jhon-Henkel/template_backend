<?php

namespace Tests\Feature\Modules\Auth\Controller\Login;

use App\Infra\Response\Enum\StatusCodeEnum;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\FeatureTestCase;

class LoginControllerFeatureTest extends FeatureTestCase
{
    #[TestDox("Testando com credenciais válidas")]
    public function testLoginRouteTestOne()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => $this->userEmail,
            'password' => 'admin',
        ]);

        $response->assertStatus(StatusCodeEnum::HttpOk->value);
        $response->assertJsonStructure(['status', 'data' => ['token']]);
    }

    #[TestDox("Testando com credenciais inválidas")]
    public function testLoginRouteTestTwo()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ]);

        $response->assertStatus(StatusCodeEnum::HttpBadRequest->value);
        $response->assertJsonStructure(['status', 'data']);
        $this->assertEquals('Credenciais inválidas', $response->json('data'));
    }
}
