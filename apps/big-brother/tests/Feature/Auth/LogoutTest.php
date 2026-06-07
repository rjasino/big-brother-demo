<?php

declare(strict_types=1);

use App\Models\User;

test('authenticated user can logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/logout')
        ->assertRedirect('/login');

    $this->assertGuest();
});

test('unauthenticated post to logout redirects to login', function () {
    $this->post('/logout')->assertRedirect('/login');
});
