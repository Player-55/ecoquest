<?php

namespace App\Http\Controllers;

use App\Models\ModuleProgress;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    private function level(int $n): array
    {
        $levels = config('ecoquest.levels');
        abort_unless(isset($levels[$n]), 404);

        return $levels[$n];
    }

    private function guard(Request $request, int $n)
    {
        $user = $request->user()->load('progress', 'tests');

        if (! $user->testScore('pre')) {
            return redirect()->route('tests.show', 'pre')->with('status', 'Please complete the pre-test first. It only takes a few minutes.');
        }
        if (! $user->isLevelUnlocked($n)) {
            return redirect()->route('dashboard')->with('status', 'Complete Level '.($n - 1).' first to unlock this level.');
        }

        return null;
    }

    private function progressFor(Request $request, int $n): ModuleProgress
    {
        return ModuleProgress::firstOrCreate(['user_id' => $request->user()->id, 'level' => $n]);
    }

    public function show(Request $request, int $level)
    {
        $data = $this->level($level);
        if ($redirect = $this->guard($request, $level)) {
            return $redirect;
        }

        return view('levels.show', [
            'n' => $level,
            'level' => $data,
            'progress' => $this->progressFor($request, $level),
            'total' => count(config('ecoquest.levels')),
        ]);
    }

    public function completeActivity(Request $request, int $level)
    {
        $this->level($level);
        abort_if($this->guard($request, $level), 403);

        $progress = $this->progressFor($request, $level);
        $awarded = 0;

        if (! $progress->activity_done) {
            $progress->activity_done = true;
            $awarded = config('ecoquest.points.activity');
            $request->user()->addPoints($awarded);
        }
        $progress->refreshCompletion();
        $progress->save();

        return response()->json([
            'awarded' => $awarded,
            'points' => $request->user()->fresh()->eco_points,
            'completed' => $progress->completed,
        ]);
    }

    public function submitQuiz(Request $request, int $level)
    {
        $data = $this->level($level);
        if ($redirect = $this->guard($request, $level)) {
            return $redirect;
        }

        $quiz = $data['quiz'];
        $rules = [];
        foreach ($quiz as $i => $q) {
            $rules["answers.$i"] = ['required', 'integer', 'between:0,'.(count($q['options']) - 1)];
        }
        $answers = $request->validate($rules, ['answers.*.required' => 'Please answer every question.'])['answers'];

        $score = 0;
        $results = [];
        foreach ($quiz as $i => $q) {
            $correct = (int) $answers[$i] === $q['answer'];
            $score += $correct ? 1 : 0;
            $results[$i] = ['chosen' => (int) $answers[$i], 'correct' => $correct];
        }

        $progress = $this->progressFor($request, $level);
        $wasCompleted = $progress->completed;
        $previousBest = $progress->quiz_best ?? 0;

        // Points only for improving on your best score, so retakes can't farm points.
        $awarded = max(0, $score - $previousBest) * config('ecoquest.points.quiz_per_correct');
        $request->user()->addPoints($awarded);

        $progress->quiz_best = max($score, $previousBest);
        $progress->quiz_attempts++;
        $progress->refreshCompletion();
        $progress->save();

        return redirect()->to(route('levels.show', $level).'#quiz')->with('quiz', [
            'score' => $score,
            'total' => count($quiz),
            'results' => $results,
            'awarded' => $awarded,
            'passed' => $score >= config('ecoquest.quiz_pass_mark'),
            'justCompleted' => ! $wasCompleted && $progress->completed,
        ]);
    }
}
