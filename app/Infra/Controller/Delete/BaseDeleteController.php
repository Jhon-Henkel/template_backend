<?php

namespace App\Infra\Controller\Delete;

use App\Infra\Controller\Controller;
use App\Infra\Enum\GatesAbilityEnum;
use App\Infra\Response\Api\ResponseApi;
use App\Infra\Response\Exceptions\ForbiddenException;
use App\Infra\UseCase\Delete\IDeleteUseCase;
use Illuminate\Http\JsonResponse;

abstract class BaseDeleteController extends Controller
{
    abstract protected function getUseCase(): IDeleteUseCase;
    abstract protected function getModelName(): string;

    public function __invoke(int $id): JsonResponse
    {
        ForbiddenException::validatePolicy(GatesAbilityEnum::Delete, $this->getModelName());
        $this->getUseCase()->execute($id);
        return ResponseApi::renderNoContent();
    }
}
