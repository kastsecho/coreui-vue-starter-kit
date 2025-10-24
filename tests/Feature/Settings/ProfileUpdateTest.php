<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function profile_page_is_displayed(): void
    {
        if (! Features::canUpdateProfileInformation()) {
            $this->markTestSkipped('Profile management is not enabled.');
        }

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('profile.edit'));

        $response->assertOk();
    }

    #[Test]
    public function profile_information_can_be_updated(): void
    {
        if (! Features::canUpdateProfileInformation()) {
            $this->markTestSkipped('Profile management is not enabled.');
        }

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->put(route('user-profile-information.update'), [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertValid()
            ->assertRedirect(route('profile.edit'));

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }

    #[Test]
    public function email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        if (! Features::canUpdateProfileInformation()) {
            $this->markTestSkipped('Profile management is not enabled.');
        }

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->put(route('user-profile-information.update'), [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertValid()
            ->assertRedirect(route('profile.edit'));

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }

    #[Test]
    public function users_can_delete_their_account(): void
    {
        if (! Features::canUpdateProfileInformation()) {
            $this->markTestSkipped('Profile management is not enabled.');
        }

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete(route('profile.destroy'), [
                'password' => 'password',
            ]);

        $response
            ->assertValid()
            ->assertRedirect(route('home'));

        $this->assertGuest();
        $this->assertModelMissing($user);
    }

    #[Test]
    public function correct_password_must_be_provided_to_delete_account(): void
    {
        if (! Features::canUpdateProfileInformation()) {
            $this->markTestSkipped('Profile management is not enabled.');
        }

        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('profile.edit'))
            ->delete(route('profile.destroy'), [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertInvalid('password')
            ->assertRedirect(route('profile.edit'));

        $this->assertModelExists($user);
    }
}
