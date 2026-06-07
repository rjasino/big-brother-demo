<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

test('forgot password page renders for guests', function () {
    $this->get('/forgot-password')->assertStatus(200);
});

test('reset link is sent for a valid email', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email])
        ->assertSessionHas('status');

    Notification::assertSentTo($user, ResetPassword::class);
});

test('no error is exposed for unknown email', function () {
    Notification::fake();

    $this->post('/forgot-password', ['email' => 'nobody@example.com'])
        ->assertSessionHasErrors('email');

    Notification::assertNothingSent();
});

test('reset password page renders with a valid token', function () {
    Notification::fake();

    $user = User::factory()->create();
    $this->post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) {
        $this->get('/reset-password/'.$notification->token)->assertStatus(200);
        return true;
    });
});

test('password can be reset with a valid token', function () {
    Notification::fake();

    $user = User::factory()->create();
    $this->post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use ($user) {
        $this->post('/reset-password', [
            'token' => $notification->token,
            'email' => $user->email,
            'password' => 'new-password1',
            'password_confirmation' => 'new-password1',
        ])->assertSessionHas('status');

        return true;
    });
});

test('password reset fails with an invalid token', function () {
    $user = User::factory()->create();

    $this->post('/reset-password', [
        'token' => 'invalid-token',
        'email' => $user->email,
        'password' => 'new-password1',
        'password_confirmation' => 'new-password1',
    ])->assertSessionHasErrors('email');
});
