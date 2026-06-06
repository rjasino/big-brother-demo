<?php

declare(strict_types=1);

test('welcome route returns inertia welcome component', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertInertia(
        fn ($page) => $page->component('Welcome')
    );
});

test('welcome route renders app name in html shell', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Big Brother SMS');
});
