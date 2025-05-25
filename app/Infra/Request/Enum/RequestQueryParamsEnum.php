<?php

namespace App\Infra\Request\Enum;

enum RequestQueryParamsEnum: string
{
    case PerPage = 'per_page';
    case Page = 'page';
    case OrderBy = 'order_by';
    case OrderDirection = 'order_direction';
    case Search = 'search';
}
