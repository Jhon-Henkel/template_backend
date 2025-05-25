<?php

namespace App\Infra\Enum;

enum StatusActiveInactiveEnum: int
{
    case Active = 1;
    case Inactive = 0;

    public static function label(int $status): string
    {
        return match ($status) {
            self::Active->value => 'Ativo',
            self::Inactive->value => 'Inativo',
            default => 'Desconhecido'
        };
    }

    public static function rawQueryCase(string $column, bool $withAlias): string
    {
        $query = "CASE $column
                    WHEN " . self::Active->value . " THEN '" . self::label(self::Active->value) . "'
                    WHEN " . self::Inactive->value . " THEN '" . self::label(self::Inactive->value) . "'
                    ELSE 'Desconhecido'
                END";
        return $withAlias ? "$query as status_label" : $query;
    }
}
