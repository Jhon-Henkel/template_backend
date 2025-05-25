<?php

namespace App\Modules\Auth\Controller\Login;

use App\Infra\Controller\Controller;
use App\Infra\Request\Validation\Validator;
use App\Infra\Response\Api\ResponseApi;
use App\Modules\Auth\UseCase\Login\LoginUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(private LoginUseCase $useCase)
    {
    }

    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required|string',
    ];

    public function __invoke(Request $request): JsonResponse
    {
        Validator::validateRequest($request, $this->rules);
        $result = $this->useCase->execute($request->input('email'), $request->input('password'));
        if (empty($result)) {
            return ResponseApi::renderInternalServerError('Erro ao fazer Login');
        }
        if ($result == 'invalid_credentials') {
            return ResponseApi::renderUnauthorized();
        }
        return ResponseApi::renderOk(['token' => $result]);
    }
}
