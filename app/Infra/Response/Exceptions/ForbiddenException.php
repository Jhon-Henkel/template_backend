<?php

namespace App\Infra\Response\Exceptions;

use App\Infra\Enum\GatesAbilityEnum;
use App\Infra\Enum\ModuleNameEnum;
use App\Models\User\User;
use Exception;
use Illuminate\Support\Facades\Gate;

class ForbiddenException extends Exception
{
    public function __construct(string $message, $defaultMessage = true)
    {
        if ($defaultMessage) {
            parent::__construct("Você não tem permissão para acessar o módulo '$message'.");
        } else {
            parent::__construct($message);
        }
    }

    public static function validatePolicy(GatesAbilityEnum $ability, string $modelName): void
    {
        if (Gate::denies($ability->value, $modelName)) {
            match ($modelName) {
                User::class => throw new self(ModuleNameEnum::getLabelPtBr(User::class)),
                default => null
            };
        }
    }
}
