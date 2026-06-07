<?php

declare(strict_types=1);

it('returns a backend bootstrap response at the root path', function (): void {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertJson([
        'name' => 'Big Brother API',
        'status' => 'ok',
    ]);
});

it('returns an api health response', function (): void {
    $response = $this->getJson('/api/health');

    $response->assertOk();
    $response->assertJson([
        'name' => 'Big Brother API',
        'status' => 'ok',
        'service' => 'backend',
    ]);
});
