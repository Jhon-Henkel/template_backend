<?php

namespace App\Infra\UseCase\Read;

interface IListUseCase
{
    public function execute(int $perPage, int $page, string $search, string $orderBy, string $orderByDirection, array|null $queryParams = null): array;
}
