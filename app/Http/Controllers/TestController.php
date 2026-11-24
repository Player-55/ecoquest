<?php

namespace App\Http\Controllers;

use App\Models\TestAttempt;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private function check(Request $request, string $type)
    {
        abort_unless(in_array($type, ['pre', 'post'], true), 404);
        $user = $request->user()->load('progress', 'tests');

        if ($type === 'post' && $user->completedLevels() < count(config('ecoquest.levels'))) {
            return redirect()->route('dashboard')->with('status', 'Finish all four levels to unlock the post-test.');
        }

        return null;
    }

    public function show(Request $request, string $type)
    {
        if ($redirect = $this->check($request, $type)) {
            return $redirect;
        }

        $attempt = $request->user()->testScore($type);

        return view('tests.show', [
            'type' => $type,
            'questions' => config('ecoquest.test'),
            'attempt' => $attempt,
            'pre' => $request->user()->testScore('pre'),
        ]);
    }

    public function submit(Request $request, string $type)
    {
        if ($redirect = $this->check($request, $type)) {
            return $redirect;
        }

        $user = $request->user();
        if ($user->testScore($type)) {
            return redirect()->route('tests.show', $type);
        }

        $questions = config('ecoquest.test');
        $rules = [];
        foreach ($questions as $i => $q) {
            $rules["answers.$i"] = ['required', 'integer', 'between:0,'.(count($q['options']) - 1)];
        }
        $answers = $request->validate($rules, ['answers.*.required' => 'Please answer every question.'])['answers'];

        $score = 0;
        foreach ($questions as $i => $q) {
            $score += (int) $answers[$i] === $q['answer'] ? 1 : 0;
        }

        TestAttempt::create([
            'user_id' => $user->id,
            'type' => $type,
            'score' => $score,
            'total' => count($questions),
            'answers' => array_map('intval', $answers),
        ]);
        $user->addPoints(config("ecoquest.points.{$type}_test"));

        return redirect()->route('tests.show', $type);
    }
}
