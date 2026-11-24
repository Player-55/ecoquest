<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home', ['levels' => config('ecoquest.levels')]);
    }

    public function dashboard(Request $request)
    {
        $user = $request->user()->load('progress', 'tests', 'survey');

        return view('dashboard', [
            'user' => $user,
            'levels' => config('ecoquest.levels'),
        ]);
    }

    public function leaderboard(Request $request)
    {
        $top = User::where('is_admin', false)
            ->orderByDesc('eco_points')->orderBy('created_at')
            ->take(10)->get();

        $rank = null;
        if ($request->user() && ! $request->user()->is_admin) {
            $rank = User::where('is_admin', false)->where('eco_points', '>', $request->user()->eco_points)->count() + 1;
        }

        return view('leaderboard', compact('top', 'rank'));
    }

    public function resources()
    {
        return view('resources');
    }

    public function about()
    {
        return view('about');
    }

    public function challenge()
    {
        return view('challenge');
    }
}
