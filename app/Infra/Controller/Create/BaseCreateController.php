<?php

namespace App\Infra\Controller\Create;

use App\Infra\Controller\Controller;
use App\Infra\Enum\GatesAbilityEnum;
use App\Infra\Request\Validation\Validator;
use App\Infra\Response\Api\ResponseApi;
use App\Infra\Response\Exceptions\BadRequestException;
use App\Infra\Response\Exceptions\ForbiddenException;
use App\Infra\UseCase\Create\ICreateUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

abstract class BaseCreateController extends Controller
{
    abstract protected function getUseCase(): ICreateUseCase;
    abstract protected function getRules(): array;
    abstract protected function getModelName(): string;

    public function __invoke(Request $request): JsonResponse
    {
        ForbiddenException::validatePolicy(GatesAbilityEnum::Create, $this->getModelName());
        Validator::validateRequest($request, $this->getRules());
        DB::beginTransaction();
        try {
            $requestData = $request->all();
            if ($request->isJson()) {
                $requestData = $request->json()->all();
            }
            $result = $this->getUseCase()->execute($requestData);
            if (!$result) {
                throw new BadRequestException('Erro ao criar objeto.');
            }
            DB::commit();
            return ResponseApi::renderCreated($result);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
