<?php

namespace App\Infra\Response\Api;

use App\Infra\Response\Enum\StatusCodeEnum;
use Illuminate\Http\JsonResponse;

class ResponseApiReal
{
    public function renderCreated(array|null $data = null): JsonResponse
    {
        return $this->responseJson($data, StatusCodeEnum::HttpCreated);
    }

    public function renderOk(array|null $data = null): JsonResponse
    {
        return $this->responseJson($data, StatusCodeEnum::HttpOk);
    }

    public function renderOkList(array|null $data = null): JsonResponse
    {
        if (is_array($data)) {
            $data['status'] = StatusCodeEnum::HttpOk->value;
        }
        return response()->json($data, StatusCodeEnum::HttpOk->value);
    }

    public function renderNoContent(): JsonResponse
    {
        return $this->responseJson(null, StatusCodeEnum::HttpNoContent);
    }

    public function renderUnauthorized(): JsonResponse
    {
        return $this->responseJson(null, StatusCodeEnum::HttpUnauthorized);
    }

    public function renderNotFount(): JsonResponse
    {
        return $this->responseJson('Objeto não encontrado!', StatusCodeEnum::HttpNotFound);
    }

    public function renderForbidden(string $message): JsonResponse
    {
        return $this->responseJson($message, StatusCodeEnum::HttpForbidden);
    }

    public function renderBadRequest(string|array|null $data = null): JsonResponse
    {
        return $this->responseJson($data, StatusCodeEnum::HttpBadRequest);
    }

    public function renderInternalServerError(string $error): JsonResponse
    {
        return $this->responseJson($error, StatusCodeEnum::HttpInternalServerError);
    }

    protected function responseJson(mixed $data, StatusCodeEnum $statusCode): JsonResponse
    {
        return response()->json($this->makeData($data, $statusCode), $statusCode->value);
    }

    protected function makeData(mixed $data, StatusCodeEnum $statusCode): array
    {
        return [
            'status' => $statusCode->value,
            'data' => $data,
        ];
    }
}
