@extends('layouts.app')
@section('title', 'Leaderboard')

@section('content')
<div class="container" style="max-width:820px;padding-top:32px;padding-bottom:48px">
    <span class="eyebrow">Leaderboard</span>
    <h1 style="font-size:2.2rem">Top Eco Heroes</h1>
    @if ($rank)
        <p class="muted">Your rank: <strong>#{{ $rank }}</strong> with {{ auth()->user()->eco_points }} Eco Points.</p>
    @endif
    <div class="card table-wrap">
        <table class="data">
            <thead><tr><th scope="col">Rank</th><th scope="col">Name</th><th scope="col">Eco Points</th></tr></thead>
            <tbody>
                @forelse ($top as $i => $u)
                    <tr @class(['me' => auth()->id() === $u->id])>
                        <td class="rank">#{{ $i + 1 }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->eco_points }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="muted">No players yet. Be the first!</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <p class="small muted" style="margin-top:12px">Earn points by finishing the pre-test, activities, quizzes, the post-test and the survey.</p>
</div>
@endsection
