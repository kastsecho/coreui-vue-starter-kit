<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function home_screen_can_be_rendered(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
    }
}
