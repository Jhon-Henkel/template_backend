<?php

namespace App\Infra\Enum;

use App\Models\User\User;

enum ModuleNameEnum: string
{
    case User = 'Usuário';

    public static function getLabelPtBr(string $modelName): string
    {
        return match ($modelName) {
            User::class => self::User->value,
            default => 'Módulo desconhecido',
        };
    }
}
