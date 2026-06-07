<?php

declare(strict_types=1);

use App\Models\User;

test('unauthenticated user is redirected from register page', function () {
    $this->get('/register')->assertRedirect('/login');
});

test('faculty user receives 403 on register page', function () {
    $faculty = User::factory()->faculty()->create();

    $this->actingAs($faculty)
        ->get('/register')
        ->assertForbidden();
});

test('registrar can view the create account page', function () {
    $registrar = User::factory()->registrar()->create();

    $this->actingAs($registrar)
        ->get('/register')
        ->assertStatus(200);
});

test('registrar can create a faculty account', function () {
    $registrar = User::factory()->registrar()->create();

    $this->actingAs($registrar)->post('/register', [
        'name' => 'Juan dela Cruz',
        'email' => 'juan@example.com',
        'password' => 'password1',
        'password_confirmation' => 'password1',
        'role' => 'faculty',
    ])->assertRedirect('/dashboard');

    $this->assertDatabaseHas('users', [
        'email' => 'juan@example.com',
        'role' => 'faculty',
    ]);
});

test('registrar can create a registrar account', function () {
    $registrar = User::factory()->registrar()->create();

    $this->actingAs($registrar)->post('/register', [
        'name' => 'Maria Santos',
        'email' => 'maria@example.com',
        'password' => 'password1',
        'password_confirmation' => 'password1',
        'role' => 'registrar',
    ])->assertRedirect('/dashboard');

    $this->assertDatabaseHas('users', [
        'email' => 'maria@example.com',
        'role' => 'registrar',
    ]);
});

test('account creation fails with duplicate email', function () {
    $registrar = User::factory()->registrar()->create();
    User::factory()->create(['email' => 'taken@example.com']);

    $this->actingAs($registrar)->post('/register', [
        'name' => 'Someone',
        'email' => 'taken@example.com',
        'password' => 'password1',
        'password_confirmation' => 'password1',
        'role' => 'faculty',
    ])->assertSessionHasErrors('email');
});

test('account creation fails with mismatched passwords', function () {
    $registrar = User::factory()->registrar()->create();

    $this->actingAs($registrar)->post('/register', [
        'name' => 'Someone',
        'email' => 'new@example.com',
        'password' => 'password1',
        'password_confirmation' => 'different',
        'role' => 'faculty',
    ])->assertSessionHasErrors('password');
});

test('account creation fails with invalid role', function () {
    $registrar = User::factory()->registrar()->create();

    $this->actingAs($registrar)->post('/register', [
        'name' => 'Someone',
        'email' => 'new@example.com',
        'password' => 'password1',
        'password_confirmation' => 'password1',
        'role' => 'admin',
    ])->assertSessionHasErrors('role');
});

test('unauthenticated user cannot post to register', function () {
    $this->post('/register', [
        'name' => 'Hacker',
        'email' => 'hack@example.com',
        'password' => 'password1',
        'password_confirmation' => 'password1',
        'role' => 'registrar',
    ])->assertRedirect('/login');

    $this->assertDatabaseMissing('users', ['email' => 'hack@example.com']);
});
