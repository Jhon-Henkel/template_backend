<?php

namespace Tests;

use App\Models\User\User;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;

abstract class FeatureTestCase extends TestCase
{
    use WithFaker;

    protected string $userEmail = 'teste_php_unit@test.com.br';
    protected string $userPassword = 'admin';
    protected User $user;
    protected string $token = '';

    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
        User::where('email', $this->userEmail)->delete();
        $this->user = User::create([
            'email' =>  $this->userEmail,
            'name' => $this->faker->name(),
            'password' => bcrypt($this->userPassword),
        ]);
    }

    protected function tearDown(): void
    {
        User::where('email', $this->userEmail)->delete();
        DB::rollBack();
        parent::tearDown();
    }

    protected function makeHeaders(): array
    {
        $token = $this->getAuthToken();
        return [
            'Authorization' => "Bearer {$token}",
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function getAuthToken(): string
    {
        if (empty($this->token)) {
            // $useCase = new LoginUseCase();
            // $this->token = $useCase->execute($this->userEmail, $this->userPassword);
            throw new \Exception('Login module not created');
        }
        return $this->token;
    }
}
