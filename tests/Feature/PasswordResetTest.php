<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_forgot_password_page_loads_and_is_linked_from_login(): void
    {
        $this->get('/login')->assertSee('Forgot your password?');
        $this->get('/forgot-password')->assertOk()->assertSee('Send reset link');
    }

    public function test_student_can_reset_password_with_emailed_link(): void
    {
        Notification::fake();
        $user = User::factory()->create(['email' => 'student@example.com']);

        $this->post('/forgot-password', ['email' => 'student@example.com'])->assertSessionHas('status');

        $token = null;
        Notification::assertSentTo($user, ResetPassword::class, function ($n) use (&$token) {
            $token = $n->token;
            return true;
        });

        $this->get("/reset-password/{$token}?email=student@example.com")->assertOk()->assertSee('Set a new password');

        $this->post('/reset-password', [
            'token' => $token,
            'email' => 'student@example.com',
            'password' => 'brand-new-pass',
            'password_confirmation' => 'brand-new-pass',
        ])->assertRedirect('/login');

        $this->assertTrue(Hash::check('brand-new-pass', $user->fresh()->password));
        $this->post('/login', ['email' => 'student@example.com', 'password' => 'brand-new-pass'])->assertRedirect('/dashboard');
    }

    public function test_unknown_email_gets_same_message_and_no_email(): void
    {
        Notification::fake();
        $this->post('/forgot-password', ['email' => 'nobody@example.com'])->assertSessionHas('status');
        Notification::assertNothingSent();
    }

    public function test_invalid_token_is_rejected(): void
    {
        $user = User::factory()->create(['email' => 'student@example.com']);
        $this->post('/reset-password', [
            'token' => 'wrong-token',
            'email' => 'student@example.com',
            'password' => 'brand-new-pass',
            'password_confirmation' => 'brand-new-pass',
        ])->assertSessionHasErrors('email');
        $this->assertFalse(Hash::check('brand-new-pass', $user->fresh()->password));
    }
}
