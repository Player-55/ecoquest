<?php

namespace App\Http\Controllers;

use App\Models\SurveyResponse;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user()->load('tests', 'survey');
        if (! $user->testScore('post')) {
            return redirect()->route('dashboard')->with('status', 'The survey opens after you finish the post-test.');
        }

        return view('survey', ['questions' => config('ecoquest.survey'), 'response' => $user->survey]);
    }

    public function submit(Request $request)
    {
        $user = $request->user()->load('tests', 'survey');
        if (! $user->testScore('post')) {
            return redirect()->route('dashboard');
        }
        if ($user->survey) {
            return redirect()->route('survey.show');
        }

        $data = $request->validate([
            'q1' => ['required', 'integer', 'between:1,5'],
            'q2' => ['required', 'integer', 'between:1,5'],
            'q3' => ['required', 'integer', 'between:1,5'],
            'q4' => ['required', 'integer', 'between:1,5'],
            'q5' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ], ['required' => 'Please rate every statement.']);

        SurveyResponse::create($data + ['user_id' => $user->id]);
        $user->addPoints(config('ecoquest.points.survey'));

        return redirect()->route('survey.show')->with('status', 'Thank you! Your feedback helps us improve EcoQuest.');
    }
}
