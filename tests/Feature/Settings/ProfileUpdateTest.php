<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/settings/profile');

        $response->assertOk();
    }

    #[Test]
    public function profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->put('/user/profile-information', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        $response
            ->assertValid()
            ->assertRedirect();

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        if ($user instanceof MustVerifyEmail) {
            $this->assertNull($user->email_verified_at);
        }
    }

    #[Test]
    public function email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->put('/user/profile-information', [
                'name' => 'Test User',
                'email' => $user->email,
            ]);

        $response
            ->assertValid()
            ->assertRedirect();

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    #[Test]
    public function user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete('/settings/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertValid()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    #[Test]
    public function correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from('/settings/profile')
            ->delete('/settings/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertInvalid('password')
            ->assertRedirect('/settings/profile');

        $this->assertNotNull($user->fresh());
    }

    #[Test]
    public function profile_photo_can_be_uploaded(): void
    {
        $user = User::factory()->create();

        Storage::fake('public');

        $response = $this
            ->actingAs($user)
            ->from('/settings/profile')
            ->put('/user/profile-information', [
                'name' => $user->name,
                'email' => $user->email,
                'photo' => UploadedFile::fake()->image('photo.jpg'),
            ]);

        $response
            ->assertValid()
            ->assertRedirect('/settings/profile');

        $user->refresh();

        $this->assertNotNull($user->profile_photo_path);
        $this->assertTrue(Storage::disk('public')->exists($user->profile_photo_path));
    }

    #[Test]
    public function profile_photo_can_be_removed(): void
    {
        $user = User::factory()->create();

        Storage::fake('public');

        $response = $this->actingAs($user)
            ->from('/settings/profile')
            ->put('/user/profile-information', [
                'name' => $user->name,
                'email' => $user->email,
                'photo' => UploadedFile::fake()->image('photo.jpg'),
            ]);

        $response->assertValid()
                 ->assertRedirect('/settings/profile');

        $user->refresh();

        $this->assertNotNull($user->profile_photo_path);
        $this->assertTrue(Storage::disk('public')->exists($user->profile_photo_path));

        $oldPath = $user->profile_photo_path;

        $response = $this->actingAs($user)
            ->delete('/settings/profile-photo');

        $response->assertValid()
                 ->assertRedirect('/settings/profile');

        $user->refresh();
        $this->assertNull($user->profile_photo_path);
        $this->assertFalse(Storage::disk('public')->exists($oldPath));
    }
}
