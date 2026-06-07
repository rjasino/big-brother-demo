<?php

declare(strict_types=1);

it('keeps the expected application name in config', function (): void {
    $appName = config('app.name');

    expect($appName)->toBe('Big Brother API');
});
