<?php

namespace App\Infra\UseCase\Create;

interface ICreateUseCase
{
    public function execute(array $data): array;
}
