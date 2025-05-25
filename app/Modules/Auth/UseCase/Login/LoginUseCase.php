<?php

namespace App\Modules\Auth\UseCase\Login;

use App\Infra\Response\Exceptions\BadRequestException;
use App\Models\User\User;

class LoginUseCase
{
    public function execute(string $login, string $password): array
    {
        $user = User::where('email', $login)->first();
        if (!$this->isValidLogin($user, $password)) {
            throw new BadRequestException('Credenciais inválidas');
        }
        $user->tokens()->delete();
        $token = $user->createToken("{$user->email}_token")->plainTextToken;
        auth()->login($user);
        return [
            'token' => $token,
            'name' => $user->name,
            'email' => $user->email,
            'id' => $user->id,
        ];
    }

    protected function isValidLogin(User|null $user, string $password): bool
    {
        if (empty($user)) {
            return false;
        }
        if (!password_verify($password, $user->password)) {
            return false;
        }
        return true;
    }
}
