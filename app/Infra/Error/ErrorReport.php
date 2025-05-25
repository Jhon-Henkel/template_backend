<?php

namespace App\Infra\Error;

use App\Infra\Request\RequestTools;
use Sentry\State\HubInterface;
use Sentry\State\Scope;
use Throwable;

class ErrorReport
{
    /** @codeCoverageIgnore */
    public static function report(Throwable $exception): void
    {
        if (RequestTools::isApplicationInDevelopMode()) {
            return;
        }
        $sentry = app(HubInterface::class);
        $sentry->configureScope(function (Scope $scope) {
            $scope->setExtra('user_ip', RequestTools::getUserIp());
            $scope->setExtra('user_agent', RequestTools::getUserAgent());
            $scope->setExtra('$_POST', $_POST);
            if (auth()->check()) {
                $user = auth()->user();
                if (! is_null($user)) {
                    $scope->setUser([
                        'id' => $user->id,
                        'email' => $user->email,
                        'name' => $user->name,
                    ]);
                }
            }
        });
        $sentry->captureException($exception);
    }
}
