<?php

use App\Infra\Error\ErrorReport;
use App\Infra\Response\Api\ResponseApi;
use App\Infra\Response\Exceptions\BadRequestException;
use App\Infra\Response\Exceptions\ForbiddenException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (AuthenticationException $e) {
            return ResponseApi::renderUnauthorized();
        });

        $exceptions->renderable(function (ForbiddenException $e) {
            return ResponseApi::renderForbidden($e->getMessage());
        });

        $exceptions->renderable(function (ModelNotFoundException|NotFoundHttpException $e) {
            return ResponseApi::renderNotFount();
        });

        $exceptions->renderable(function (BadRequestException $e) {
            return ResponseApi::renderBadRequest($e->getMessage());
        });

        $exceptions->renderable(function (Throwable $e) {
            // Quando o Sanctum dá autenticação inválida, ele tenta redirecionar para a rota de login, como não existe, dá erro.
            if ($e instanceof RouteNotFoundException && $e->getMessage() === 'Route [login] not defined.') {
                return ResponseApi::renderUnauthorized();
            }
            // Validando erro de quando a chave do array não existir e tiver tentando ser acessada.
            if (str_contains($e->getMessage(), 'Undefined array key')) {
                return ResponseApi::renderBadRequest($e->getMessage());
            }
            ErrorReport::report($e);
            return ResponseApi::renderInternalServerError($e->getMessage());
        });
    })->create();
