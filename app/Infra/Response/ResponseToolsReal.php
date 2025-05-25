<?php

namespace App\Infra\Response;

use App\Infra\Request\RequestTools;

class ResponseToolsReal
{
    public function replaceUrlIfLocalhost(string $url): string
    {
        if (! RequestTools::isApplicationInDevelopMode()) {
            return $url;
        }
        return str_replace(config('app.container_name'), 'localhost:8080', $url);
    }

    public function replaceUrlLocalhostToContainer(string $url): string
    {
        if (! RequestTools::isApplicationInDevelopMode()) {
            return $url;
        }
        return str_replace('localhost:8080', config('app.container_name'), $url);
    }
}
