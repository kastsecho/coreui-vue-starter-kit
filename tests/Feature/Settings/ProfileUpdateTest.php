<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
            ->from(route('profile.edit'))
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
        $this->assertFalse($user->hasVerifiedEmail());
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
            ->from(route('profile.edit'))
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

    #[Test]
    public function profile_photo_can_be_uploaded(): void
    {
        if (! Features::canUpdateProfileInformation()) {
            $this->markTestSkipped('Profile management is not enabled.');
        }

        $user = User::factory()->create();

        Storage::fake('public');

        $response = $this
            ->actingAs($user)
            ->from(route('profile.edit'))
            ->put(route('user-profile-information.update'), [
                'name' => $user->name,
                'email' => $user->email,
                'photo' => UploadedFile::fake()->image('photo.jpg'),
            ]);

        $response
            ->assertValid()
            ->assertRedirect(route('profile.edit'));

        $user->refresh();

        $this->assertNotNull($user->profile_photo_path);
        $this->assertTrue(Storage::disk('public')->exists($user->profile_photo_path));
    }

    #[Test]
    public function profile_photo_can_be_removed(): void
    {
        if (! Features::canUpdateProfileInformation()) {
            $this->markTestSkipped('Profile management is not enabled.');
        }

        $user = User::factory()->create();

        Storage::fake('public');

        $response = $this->actingAs($user)
            ->from(route('profile.edit'))
            ->put(route('user-profile-information.update'), [
                'name' => $user->name,
                'email' => $user->email,
                'photo' => UploadedFile::fake()->image('photo.jpg'),
            ]);

        $response
            ->assertValid()
            ->assertRedirect(route('profile.edit'));

        $user->refresh();

        $this->assertNotNull($user->profile_photo_path);
        $this->assertTrue(Storage::disk('public')->exists($user->profile_photo_path));

        $oldPath = $user->profile_photo_path;

        $response = $this
            ->actingAs($user)
            ->delete(route('profile-photo.destroy'));

        $response
            ->assertValid()
            ->assertRedirect(route('profile.edit'));

        $user->refresh();

        $this->assertNull($user->profile_photo_path);
        $this->assertFalse(Storage::disk('public')->exists($oldPath));
    }
}
