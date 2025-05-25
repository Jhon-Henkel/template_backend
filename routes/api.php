<?php

use App\Infra\Route\Enum\RouteNameEnum;
use App\Modules\Auth\Controller\Login\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', LoginController::class)->name(RouteNameEnum::ApiAuthLogin);
});

Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    Route::get('test', function () {
        return response()->json(['message' => 'Test auth route is working!']);
    });
});
