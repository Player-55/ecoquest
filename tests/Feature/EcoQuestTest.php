<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EcoQuestTest extends TestCase
{
    use RefreshDatabase;

    private function answers(array $questions, bool $allCorrect = true): array
    {
        $a = [];
        foreach ($questions as $i => $q) {
            $a[$i] = $allCorrect ? $q['answer'] : ($q['answer'] + 1) % count($q['options']);
        }

        return $a;
    }

    public function test_public_pages_load(): void
    {
        foreach (['/', '/login', '/register', '/resources', '/about', '/leaderboard'] as $url) {
            $this->get($url)->assertOk();
        }
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_full_student_journey(): void
    {
        $this->post('/register', [
            'name' => 'Aiman', 'email' => 'aiman@example.com',
            'password' => 'password123', 'password_confirmation' => 'password123',
        ])->assertRedirect('/tests/pre');

        $user = User::where('email', 'aiman@example.com')->firstOrFail();

        // Levels are locked before the pre-test
        $this->get('/levels/1')->assertRedirect('/tests/pre');
        $this->get('/tests/pre')->assertOk()->assertSee('Pre-test');

        $test = config('ecoquest.test');
        $pre = $this->answers($test);
        $pre[0] = ($pre[0] + 1) % 4; $pre[1] = ($pre[1] + 1) % 4; // 8/10
        $this->post('/tests/pre', ['answers' => $pre])->assertRedirect('/tests/pre');
        $this->assertSame(8, $user->tests()->where('type', 'pre')->first()->score);

        $this->get('/levels/2')->assertRedirect('/dashboard'); // locked
        $this->get('/tests/post')->assertRedirect('/dashboard'); // locked

        foreach (config('ecoquest.levels') as $n => $level) {
            $this->get("/levels/$n")->assertOk()->assertSee($level['title'])->assertSee('Malaysia Corner');
            // failing quiz does not complete
            $this->post("/levels/$n/quiz", ['answers' => $this->answers($level['quiz'], false)])->assertRedirect();
            $this->postJson("/levels/$n/activity")->assertOk()->assertJson(['awarded' => 20, 'completed' => false]);
            $this->postJson("/levels/$n/activity")->assertJson(['awarded' => 0]);
            $this->post("/levels/$n/quiz", ['answers' => $this->answers($level['quiz'])])->assertRedirect();
            $this->get("/levels/$n")->assertSee('Level '.$n.' complete!', false);
        }

        $user->refresh()->load('progress');
        $this->assertSame(4, $user->completedLevels());

        $this->post('/tests/post', ['answers' => $this->answers($test)])->assertRedirect('/tests/post');
        $this->get('/tests/post')->assertSee('+2');

        $this->post('/survey', ['q1' => 5, 'q2' => 4, 'q3' => 5, 'q4' => 4, 'q5' => 5, 'comment' => 'Fun!'])->assertRedirect('/survey');

        // 10 pre + 4*(20 + 50) quiz/activity + 10 post + 10 survey
        $this->assertSame(310, $user->fresh()->eco_points);
        $this->get('/dashboard')->assertOk()->assertSee('Eco Hero');
        $this->get('/leaderboard')->assertSee('Aiman');
        $this->get('/green-challenge')->assertOk();

        // Students cannot open admin
        $this->get('/admin')->assertForbidden();
    }

    public function test_admin_can_see_results_and_export(): void
    {
        $admin = User::factory()->create(['email' => 'admin@ecoquest.test', 'password' => 'test-admin-pass', 'is_admin' => true]);
        User::factory()->create(['name' => 'Student One']);

        $this->post('/login', ['email' => 'admin@ecoquest.test', 'password' => 'test-admin-pass'])->assertRedirect('/admin');
        $this->actingAs($admin)->get('/admin')->assertOk()->assertSee('Student One');
        $res = $this->actingAs($admin)->get('/admin/export');
        $res->assertOk();
        $this->assertStringContainsString('Student One', $res->streamedContent());
    }
}
