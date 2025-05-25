<?php

namespace App\Infra\Enum;

enum GatesAbilityEnum: string
{
    case Create = 'create';
    case List = 'list';
    case Get = 'get';
    case Update = 'update';
    case Delete = 'delete';
}
