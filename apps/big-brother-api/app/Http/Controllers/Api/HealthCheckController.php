<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class HealthCheckController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'name' => 'Big Brother API',
            'status' => 'ok',
            'service' => 'backend',
        ]);
    }
}
