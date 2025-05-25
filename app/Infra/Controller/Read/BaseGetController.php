<?php

namespace App\Infra\Controller\Read;

use App\Infra\Controller\Controller;
use App\Infra\Enum\GatesAbilityEnum;
use App\Infra\Response\Api\ResponseApi;
use App\Infra\Response\Exceptions\ForbiddenException;
use App\Infra\UseCase\Read\IGetUseCase;
use Illuminate\Http\JsonResponse;

abstract class BaseGetController extends Controller
{
    abstract protected function getUseCase(): IGetUseCase;
    abstract protected function getModelName(): string;

    public function __invoke(int $id): JsonResponse
    {
        ForbiddenException::validatePolicy(GatesAbilityEnum::Get, $this->getModelName());
        $result = $this->getUseCase()->execute($id);
        return ResponseApi::renderOk($result);
    }
}
