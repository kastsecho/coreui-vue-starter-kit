<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/settings/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated()
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

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged()
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

    public function test_user_can_delete_their_account()
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

    public function test_correct_password_must_be_provided_to_delete_account()
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

    public function test_profile_photo_can_be_uploaded()
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

    public function test_profile_photo_can_be_removed()
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
