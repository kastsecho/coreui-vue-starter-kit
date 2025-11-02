<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Features;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function password_update_page_is_displayed(): void
    {
        if (! Features::enabled(Features::updatePasswords())) {
            $this->markTestSkipped('Password updating is not enabled.');
        }

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('password.edit'));

        $response->assertStatus(200);
    }

    #[Test]
    public function password_can_be_updated(): void
    {
        if (! Features::enabled(Features::updatePasswords())) {
            $this->markTestSkipped('Password updating is not enabled.');
        }

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('password.edit'))
            ->put(route('user-password.update'), [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertValid()
            ->assertRedirect(route('password.edit'));

        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    #[Test]
    public function correct_password_must_be_provided_to_update_password(): void
    {
        if (! Features::enabled(Features::updatePasswords())) {
            $this->markTestSkipped('Password updating is not enabled.');
        }

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('password.edit'))
            ->put(route('user-password.update'), [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertInvalid('current_password')
            ->assertRedirect(route('password.edit'));
    }
}
