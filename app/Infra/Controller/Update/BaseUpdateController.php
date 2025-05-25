<?php

namespace App\Infra\Controller\Update;

use App\Infra\Controller\Controller;
use App\Infra\Enum\GatesAbilityEnum;
use App\Infra\Request\Validation\Validator;
use App\Infra\Response\Api\ResponseApi;
use App\Infra\Response\Exceptions\BadRequestException;
use App\Infra\Response\Exceptions\ForbiddenException;
use App\Infra\UseCase\Update\IUpdateUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

abstract class BaseUpdateController extends Controller
{
    abstract protected function getUseCase(): IUpdateUseCase;
    abstract protected function getRules(): array;
    abstract protected function getModelName(): string;

    public function __invoke(Request $request, int $id): JsonResponse
    {
        ForbiddenException::validatePolicy(GatesAbilityEnum::Update, $this->getModelName());
        Validator::validateRequest($request, $this->getRules());
        DB::beginTransaction();
        try {
            $requestData = $request->all();
            if ($request->isJson()) {
                $requestData = $request->json()->all();
            }
            $result = $this->getUseCase()->execute($requestData, $id);
            if (!$result) {
                throw new BadRequestException('Erro ao atualizar o objeto.');
            }
            DB::commit();
            return ResponseApi::renderOk($result);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function getId(): object|string|null
    {
        return request()->route('id');
    }
}
