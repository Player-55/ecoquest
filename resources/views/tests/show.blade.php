@extends('layouts.app')
@section('title', $type === 'pre' ? 'Pre-test' : 'Post-test')

@section('content')
<div class="container" style="max-width:820px;padding-top:32px;padding-bottom:48px">
    <span class="eyebrow">{{ $type === 'pre' ? 'Before you start' : 'Final step' }}</span>
    <h1 style="font-size:2.2rem">{{ $type === 'pre' ? 'Pre-test' : 'Post-test' }}</h1>

    @if ($attempt)
        <div class="card">
            <h2>You scored {{ $attempt->score }}/{{ $attempt->total }}</h2>
            @if ($type === 'pre')
                <p>Thanks! This is your starting point. At the end of your quest you will take the same test again to see how much you have learned.</p>
                <a href="{{ route('levels.show', 1) }}" class="btn btn-primary">Start Level 1</a>
            @else
                @if ($pre)
                    @php $gain = $attempt->score - $pre->score; @endphp
                    <div class="facts">
                        <div class="fact"><span class="big">{{ $pre->score }}/{{ $pre->total }}</span>Pre-test</div>
                        <div class="fact"><span class="big">{{ $attempt->score }}/{{ $attempt->total }}</span>Post-test</div>
                        <div class="fact"><span class="big">{{ $gain >= 0 ? '+' : '' }}{{ $gain }}</span>Improvement</div>
                    </div>
                @endif
                <p>Congratulations on finishing EcoQuest! Please take two minutes to tell us what you think.</p>
                <div class="btn-row">
                    <a href="{{ route('survey.show') }}" class="btn btn-primary">Give feedback</a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline">Back to my quest</a>
                </div>
            @endif
        </div>
    @else
        <p class="muted">
            @if ($type === 'pre')
                Answer 10 quick questions. Don't worry if you don't know the answers yet; this only measures your starting point. You can take this test once.
            @else
                You've finished all four levels! Answer the same 10 questions again to see how much you've learned. You can take this test once.
            @endif
        </p>
        @if ($errors->any()) <div class="alert alert-error">{{ $errors->first() }}</div> @endif
        <form method="POST" action="{{ route('tests.submit', $type) }}">
            @csrf
            @foreach ($questions as $i => $q)
                <fieldset class="quiz-q">
                    <legend>{{ $i + 1 }}. {{ $q['q'] }}</legend>
                    @foreach ($q['options'] as $j => $opt)
                        <label><input type="radio" name="answers[{{ $i }}]" value="{{ $j }}" required @checked(old("answers.$i") === (string) $j)> <span>{{ $opt }}</span></label>
                    @endforeach
                </fieldset>
            @endforeach
            <button type="submit" class="btn btn-primary">Submit {{ $type === 'pre' ? 'pre-test' : 'post-test' }}</button>
        </form>
    @endif
</div>
@endsection
