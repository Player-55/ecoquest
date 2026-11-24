<?php

namespace App\Http\Controllers;

use App\Models\SurveyResponse;
use App\Models\User;

class AdminController extends Controller
{
    private function students()
    {
        return User::where('is_admin', false)->with('progress', 'tests', 'survey')->orderBy('name')->get();
    }

    public function index()
    {
        $students = $this->students();

        $pre = $students->map(fn ($s) => $s->testScore('pre')?->score)->filter(fn ($v) => $v !== null);
        $post = $students->map(fn ($s) => $s->testScore('post')?->score)->filter(fn ($v) => $v !== null);
        $paired = $students->filter(fn ($s) => $s->testScore('pre') && $s->testScore('post'));
        $gain = $paired->map(fn ($s) => $s->testScore('post')->score - $s->testScore('pre')->score);

        $surveys = SurveyResponse::with('user')->latest()->get();
        $surveyAverages = [];
        foreach (config('ecoquest.survey') as $key => $text) {
            $surveyAverages[$key] = ['text' => $text, 'avg' => $surveys->count() ? round($surveys->avg($key), 2) : null];
        }

        $levelCounts = [];
        foreach (config('ecoquest.levels') as $n => $level) {
            $levelCounts[$n] = ['title' => $level['title'], 'count' => $students->filter(fn ($s) => $s->isLevelComplete($n))->count()];
        }

        return view('admin.index', [
            'students' => $students,
            'stats' => [
                'students' => $students->count(),
                'pre_count' => $pre->count(),
                'post_count' => $post->count(),
                'pre_avg' => $pre->count() ? round($pre->avg(), 2) : null,
                'post_avg' => $post->count() ? round($post->avg(), 2) : null,
                'gain_avg' => $gain->count() ? round($gain->avg(), 2) : null,
                'total' => count(config('ecoquest.test')),
            ],
            'surveys' => $surveys,
            'surveyAverages' => $surveyAverages,
            'levelCounts' => $levelCounts,
        ]);
    }

    public function export()
    {
        $students = $this->students();
        $levels = config('ecoquest.levels');

        return response()->streamDownload(function () use ($students, $levels) {
            $out = fopen('php://output', 'w');
            $header = ['Name', 'Email', 'Eco Points', 'Pre-test', 'Post-test', 'Gain'];
            foreach ($levels as $n => $l) {
                $header[] = "Level $n quiz best";
            }
            array_push($header, 'Survey Q1', 'Survey Q2', 'Survey Q3', 'Survey Q4', 'Survey Q5', 'Comment');
            fputcsv($out, $header);

            foreach ($students as $s) {
                $pre = $s->testScore('pre')?->score;
                $post = $s->testScore('post')?->score;
                $row = [$s->name, $s->email, $s->eco_points, $pre, $post, ($pre !== null && $post !== null) ? $post - $pre : null];
                foreach ($levels as $n => $l) {
                    $row[] = $s->levelProgress($n)?->quiz_best;
                }
                $sv = $s->survey;
                array_push($row, $sv?->q1, $sv?->q2, $sv?->q3, $sv?->q4, $sv?->q5, $sv?->comment);
                fputcsv($out, $row);
            }
            fclose($out);
        }, 'ecoquest-results-'.now()->format('Y-m-d').'.csv', ['Content-Type' => 'text/csv']);
    }
}
