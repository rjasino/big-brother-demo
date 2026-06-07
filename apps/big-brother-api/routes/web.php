<?php

declare(strict_types=1);

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return new JsonResponse([
        'name' => 'Big Brother API',
        'status' => 'ok',
        'message' => 'Laravel backend bootstrap is ready.',
    ]);
});
