<?php

namespace App\Modules\Auth\UseCase\Login;

use App\Models\User\User;

class LoginUseCase
{
    public function execute(string $login, string $password): string
    {
        $user = User::where('email', $login)->first();
        if (! $this->isValidLogin($user, $password)) {
            return 'invalid_credentials';
        }
        $user->tokens()->delete();
        $token = $user->createToken("{$user->email}_token")->plainTextToken;
        auth()->login($user);
        return $token;
    }

    protected function isValidLogin(User|null $user, string $password): bool
    {
        if (empty($user)) {
            return false;
        }
        if (! password_verify($password, $user->password)) {
            return false;
        }
        return true;
    }
}
