@extends('layouts.app')
@section('title', "Level $n: ".$level['title'])

@php
    $quizResult = session('quiz');
    $steps = [
        ['id' => 'watch', 'label' => 'Watch the intro', 'gagne' => '1. Gain attention'],
        ['id' => 'objectives', 'label' => 'What you will learn', 'gagne' => '2. Inform objectives'],
        ['id' => 'recall', 'label' => 'Quick recall', 'gagne' => '3. Stimulate recall'],
        ['id' => 'learn', 'label' => 'Learn', 'gagne' => '4. Present content'],
        ['id' => 'corner', 'label' => 'Malaysia Corner', 'gagne' => '5. Provide guidance'],
        ['id' => 'activity', 'label' => 'Activity: '.$level['activity_name'], 'gagne' => '6–7. Practice + feedback'],
        ['id' => 'quiz', 'label' => 'Level quiz', 'gagne' => '8. Assess performance'],
        ['id' => 'summary', 'label' => 'Summary & next steps', 'gagne' => '9. Enhance retention'],
    ];
@endphp

@section('content')
<div class="level-layout">
    <aside class="level-side card">
        <span class="eyebrow">Level {{ $n }} of {{ $total }}</span>
        <h2 style="font-size:1.3rem">{{ $level['title'] }}</h2>
        <div class="small muted" style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:8px">
            <span @class(['tag', 'tag-green' => $progress->activity_done, 'tag-grey' => ! $progress->activity_done]) id="side-activity">Activity {{ $progress->activity_done ? 'done' : 'to do' }}</span>
            <span @class(['tag', 'tag-green' => $progress->quiz_best >= config('ecoquest.quiz_pass_mark'), 'tag-grey' => $progress->quiz_best < config('ecoquest.quiz_pass_mark')])>Quiz {{ $progress->quiz_best !== null ? $progress->quiz_best.'/5' : 'to do' }}</span>
        </div>
        <nav aria-label="Level steps">
            <ol class="steps">
                @foreach ($steps as $i => $s)
                    <li><a href="#{{ $s['id'] }}"><span class="dot">{{ $i + 1 }}</span><span>{{ $s['label'] }}<span class="gagne">Gagné {{ $s['gagne'] }}</span></span></a></li>
                @endforeach
            </ol>
        </nav>
    </aside>

    <div class="level-main">
        {{-- 1. Gain attention --}}
        <section id="watch" class="block">
            <div class="block-head"><span class="gagne-tag">Gagné 1 · Gain attention</span></div>
            <h1 style="font-size:2.2rem">{{ $level['tagline'] }}</h1>
            <div class="video-box">
                @if ($level['video'])
                    <iframe src="{{ $level['video'] }}" title="{{ $level['video_caption'] }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    <span class="play" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24"><path d="M8 5l11 7-11 7z" fill="#1F1300"/></svg></span>
                    <strong>{{ $level['video_caption'] }}</strong>
                    <span class="small" style="opacity:.8">Video placeholder: add your group's video link in config/ecoquest.php</span>
                @endif
            </div>
            <p class="hook" style="margin-top:16px">{{ $level['hook'] }}</p>
        </section>

        {{-- 2. Objectives --}}
        <section id="objectives" class="block card">
            <div class="block-head"><span class="gagne-tag">Gagné 2 · Inform learners of objectives</span></div>
            <h2 style="font-size:1.3rem">By the end of this level, you will be able to:</h2>
            <ul class="objectives mb-0">
                @foreach ($level['objectives'] as $o) <li>{{ $o }}</li> @endforeach
            </ul>
        </section>

        {{-- 3. Recall --}}
        <section id="recall" class="block callout">
            <div class="block-head"><span class="gagne-tag">Gagné 3 · Stimulate recall of prior learning</span></div>
            <p class="mb-0"><strong>Think first:</strong> {{ $level['recall'] }}</p>
        </section>

        {{-- 4. Present content --}}
        <section id="learn" class="block content">
            <div class="block-head"><span class="gagne-tag">Gagné 4 · Present the content</span></div>
            @include("levels.content.$n", ['part' => 'learn'])
        </section>

        {{-- 5. Guidance: Malaysia Corner --}}
        <section id="corner" class="block my-corner">
            <div class="block-head"><span class="gagne-tag">Gagné 5 · Provide learning guidance</span></div>
            <span class="flag">
                <svg width="22" height="22" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22V4"/><path d="M4 4h13l-2 4 2 4H4"/></svg>
                Malaysia Corner
            </span>
            @include("levels.content.$n", ['part' => 'corner'])
        </section>

        {{-- 6–7. Practice + feedback --}}
        <section id="activity" class="block activity {{ $progress->activity_done ? 'is-done' : '' }}" data-level="{{ $n }}" data-url="{{ route('levels.activity', $n) }}">
            <div class="block-head"><span class="gagne-tag">Gagné 6 &amp; 7 · Elicit performance + provide feedback</span></div>
            <span class="eyebrow">Activity</span>
            <h2>{{ $level['activity_name'] }}</h2>
            @include("levels.activities.$n")
            <div class="activity-done alert alert-success" role="status" style="margin-bottom:0">
                <strong>Activity complete!</strong> <span class="activity-msg">You earned the activity Eco Points for this level.</span> Now try the level quiz below.
            </div>
        </section>

        {{-- 8. Assess --}}
        <section id="quiz" class="block card">
            <div class="block-head"><span class="gagne-tag">Gagné 8 · Assess performance</span></div>
            <h2>Level {{ $n }} quiz</h2>
            @if ($quizResult)
                <div @class(['alert', 'alert-success' => $quizResult['passed'], 'alert-error' => ! $quizResult['passed']]) role="status">
                    <strong>You scored {{ $quizResult['score'] }}/{{ $quizResult['total'] }}.</strong>
                    @if ($quizResult['awarded']) +{{ $quizResult['awarded'] }} Eco Points. @endif
                    @if ($quizResult['passed'])
                        Well done, you passed!
                    @else
                        You need {{ config('ecoquest.quiz_pass_mark') }} correct to pass. Read the feedback below and try again.
                    @endif
                    @if ($quizResult['justCompleted'])
                        <br><strong>Level {{ $n }} complete!</strong> You earned the "{{ $level['badge'] }}" badge and your planet just got greener.
                    @elseif ($quizResult['passed'] && ! $progress->activity_done)
                        <br>Finish the activity above to complete this level.
                    @endif
                </div>
                @foreach ($level['quiz'] as $i => $q)
                    @php $r = $quizResult['results'][$i]; @endphp
                    <div @class(['quiz-q', 'is-right' => $r['correct'], 'is-wrong' => ! $r['correct']])>
                        <p class="mb-0"><strong>{{ $i + 1 }}. {{ $q['q'] }}</strong></p>
                        <p class="small mb-0" style="margin-top:6px">
                            Your answer: {{ $q['options'][$r['chosen']] }} {{ $r['correct'] ? '✓' : '✗' }}
                            @unless ($r['correct']) <br>Correct answer: <strong>{{ $q['options'][$q['answer']] }}</strong> @endunless
                        </p>
                        <div class="explain">{{ $q['explain'] }}</div>
                    </div>
                @endforeach
                <a href="{{ route('levels.show', $n) }}#quiz" class="btn btn-outline">Try the quiz again</a>
            @else
                <p class="muted">Answer all 5 questions. You need {{ config('ecoquest.quiz_pass_mark') }} correct to pass. You get feedback on every answer.</p>
                @if ($errors->any()) <div class="alert alert-error">{{ $errors->first() }}</div> @endif
                <form method="POST" action="{{ route('levels.quiz', $n) }}">
                    @csrf
                    @foreach ($level['quiz'] as $i => $q)
                        <fieldset class="quiz-q">
                            <legend>{{ $i + 1 }}. {{ $q['q'] }}</legend>
                            @foreach ($q['options'] as $j => $opt)
                                <label><input type="radio" name="answers[{{ $i }}]" value="{{ $j }}" required @checked(old("answers.$i") === (string) $j)> <span>{{ $opt }}</span></label>
                            @endforeach
                        </fieldset>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit answers</button>
                </form>
            @endif
        </section>

        {{-- 9. Retention --}}
        <section id="summary" class="block card">
            <div class="block-head"><span class="gagne-tag">Gagné 9 · Enhance retention and transfer</span></div>
            <h2>Key takeaways</h2>
            @include("levels.content.$n", ['part' => 'summary'])
            <div class="btn-row">
                @if ($n < $total)
                    <a href="{{ route('levels.show', $n + 1) }}" class="btn btn-primary">Next: Level {{ $n + 1 }}</a>
                @else
                    <a href="{{ route('tests.show', 'post') }}" class="btn btn-primary">Take the post-test</a>
                @endif
                <a href="{{ route('dashboard') }}" class="btn btn-outline">Back to my quest</a>
                <a href="{{ route('challenge') }}" class="btn btn-ghost">7-Day Green Challenge</a>
            </div>
            <p class="small muted" style="margin-top:12px">The next level unlocks when you finish this level's activity and pass its quiz.</p>
        </section>

        <section class="block">
            <h2 style="font-size:1.1rem">Sources</h2>
            @include("levels.content.$n", ['part' => 'sources'])
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/activities.js') }}?v=1"></script>
@endpush
