<?php

declare(strict_types=1);

use App\Models\User;

test('isFaculty returns true when role is faculty', function () {
    $user = new User(['role' => 'faculty']);

    expect($user->isFaculty())->toBeTrue();
    expect($user->isRegistrar())->toBeFalse();
});

test('isRegistrar returns true when role is registrar', function () {
    $user = new User(['role' => 'registrar']);

    expect($user->isRegistrar())->toBeTrue();
    expect($user->isFaculty())->toBeFalse();
});

test('faculty relationship method exists', function () {
    $user = new User();

    expect(method_exists($user, 'faculty'))->toBeTrue();
});
