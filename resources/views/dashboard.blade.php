@extends('layouts.app')
@section('title', 'My quest')

@php
    $total = count($levels);
    $done = $user->completedLevels();
    $pre = $user->testScore('pre');
    $post = $user->testScore('post');
@endphp

@section('content')
<section class="section-tight">
    <div class="container">
        <div class="grid grid-2" style="align-items:center">
            <div>
                <span class="eyebrow">My quest</span>
                <h1 style="font-size:2.2rem">Hi {{ $user->name }}!</h1>
                <p class="muted">You have completed <strong>{{ $done }} of {{ $total }}</strong> levels.
                    @if ($done < $total) Keep going to heal your planet. @else Your planet is fully healed! @endif
                </p>
                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="{{ $total }}" aria-valuenow="{{ $done }}" aria-label="Levels completed"><span style="width: {{ $total ? round($done / $total * 100) : 0 }}%"></span></div>
                <div class="grid" style="margin-top:20px;grid-template-columns:repeat(auto-fit,minmax(140px,1fr))">
                    <div class="card stat"><span class="muted small">Eco Points</span><span class="num">{{ $user->eco_points }}</span></div>
                    <div class="card stat"><span class="muted small">Pre-test</span><span class="num">{{ $pre ? $pre->score.'/'.$pre->total : '–' }}</span></div>
                    <div class="card stat"><span class="muted small">Post-test</span><span class="num">{{ $post ? $post->score.'/'.$post->total : '–' }}</span></div>
                </div>
            </div>
            <figure class="center mb-0">
                @include('partials.planet', ['stage' => $user->planetStage(), 'id' => 'dash'])
                <figcaption class="small muted">Planet health: {{ $done }}/{{ $total }}</figcaption>
            </figure>
        </div>

        @unless ($pre)
            <div class="card" style="margin-top:24px;border-color:var(--sun);background:var(--sun-tint)">
                <h3>Step 1: Take the pre-test</h3>
                <p class="mb-0">Answer 10 quick questions before you start, so you can see how much you learn. <a href="{{ route('tests.show', 'pre') }}" class="btn btn-sun btn-sm" style="margin-left:8px">Start pre-test</a></p>
            </div>
        @endunless

        <h2 style="margin-top:40px">Levels</h2>
        <div class="grid grid-4">
            @foreach ($levels as $n => $level)
                @php
                    $unlocked = $user->isLevelUnlocked($n);
                    $complete = $user->isLevelComplete($n);
                    $p = $user->levelProgress($n);
                @endphp
                @if ($unlocked)
                    <a href="{{ route('levels.show', $n) }}" @class(['card', 'level-card', 'done' => $complete])>
                @else
                    <div class="card level-card locked" aria-disabled="true">
                @endif
                    <span class="level-num">{{ $complete ? '✓' : $n }}</span>
                    <h3 class="mb-0">{{ $level['title'] }}</h3>
                    <p class="muted small mb-0">{{ $level['tagline'] }}</p>
                    <div class="card-foot">
                        @if ($complete)
                            <span class="tag tag-green">Completed · quiz {{ $p->quiz_best }}/5</span>
                        @elseif ($unlocked)
                            <span class="tag">{{ $p && ($p->activity_done || $p->quiz_best !== null) ? 'In progress' : 'Ready to play' }}</span>
                        @else
                            <span class="tag tag-grey">Locked</span>
                        @endif
                    </div>
                @if ($unlocked) </a> @else </div> @endif
            @endforeach
        </div>

        <div class="grid grid-2" style="margin-top:24px">
            <div class="card">
                <h3>Final steps</h3>
                <p class="muted">Finish all four levels to unlock the post-test, then tell us what you think.</p>
                <div class="btn-row" style="margin-top:0">
                    @if ($done >= $total)
                        <a href="{{ route('tests.show', 'post') }}" class="btn btn-primary">{{ $post ? 'View post-test result' : 'Take the post-test' }}</a>
                    @else
                        <span class="btn btn-outline" aria-disabled="true">Post-test (locked)</span>
                    @endif
                    @if ($post)
                        <a href="{{ route('survey.show') }}" class="btn btn-outline">{{ $user->survey ? 'Survey submitted' : 'Give feedback' }}</a>
                    @endif
                </div>
            </div>
            <div class="card">
                <h3>7-Day Green Challenge</h3>
                <p class="muted">Turn what you learn into real habits with a printable one-week checklist.</p>
                <a href="{{ route('challenge') }}" class="btn btn-outline">Open the challenge</a>
            </div>
        </div>

        <h2 style="margin-top:40px">Badges</h2>
        <div class="badges">
            @foreach ($user->badges() as $badge)
                <div @class(['badge', 'earned' => $badge['earned']])>
                    <span class="medal">
                        @if ($badge['earned'])
                            @include('partials.leaf', ['size' => 24])
                        @else
                            <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="#64748B" stroke-width="2"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
                        @endif
                    </span>
                    <span class="name">{{ $badge['name'] }}</span>
                    <span class="hint">{{ $badge['earned'] ? 'Earned' : $badge['hint'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
