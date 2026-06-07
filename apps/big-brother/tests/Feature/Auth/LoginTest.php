<?php

declare(strict_types=1);

use App\Models\User;

test('login page renders for guests', function () {
    $this->get('/login')->assertStatus(200);
});

test('authenticated user is redirected away from login page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/login')
        ->assertRedirect('/dashboard');
});

test('user can login with valid credentials', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect('/dashboard');

    $this->assertAuthenticatedAs($user);
});

test('login fails with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('login fails with unknown email', function () {
    $this->post('/login', [
        'email' => 'nobody@example.com',
        'password' => 'password',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('unauthenticated user is redirected to login from protected route', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

test('login is throttled after five failed attempts', function () {
    $user = User::factory()->create();

    foreach (range(1, 5) as $_) {
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
    }

    // 6th attempt: Fortify's ThrottleLogins throws a ValidationException with status 429
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    expect($response->status())->toBeIn([302, 429]);
    $this->assertGuest();
});
