<?php

namespace App\Infra\Request;

class RequestToolsReal
{
    public function isApplicationInDevelopMode(): bool
    {
        return config('app.env') != 'production';
    }

    public function getUserIp(): string|null
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];
            $ipList = explode(',', is_string($forwarded) ? $forwarded : '');
            return trim($ipList[0]);
        }
        return is_string($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
    }

    public function getUserAgent(): string|null
    {
        return is_string($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
    }
}
