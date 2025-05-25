<?php

namespace App\Infra\UseCase\Delete;

interface IDeleteUseCase
{
    public function execute(int $id): void;
}
