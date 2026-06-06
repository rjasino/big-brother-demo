<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

final class WelcomeTest extends TestCase
{
    public function test_welcome_route_returns_inertia_welcome_component(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(
            fn ($page) => $page->component('Welcome')
        );
    }

    public function test_welcome_route_renders_app_name_in_html_shell(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Big Brother SMS');
    }
}
