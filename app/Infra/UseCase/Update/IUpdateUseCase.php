<?php

namespace App\Infra\UseCase\Update;

interface IUpdateUseCase
{
    public function execute(array $data, int $id): array;
}
