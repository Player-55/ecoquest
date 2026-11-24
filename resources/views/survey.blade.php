@extends('layouts.app')
@section('title', 'Feedback survey')

@section('content')
<div class="container" style="max-width:820px;padding-top:32px;padding-bottom:48px">
    <span class="eyebrow">Evaluation</span>
    <h1 style="font-size:2.2rem">Tell us what you think</h1>

    @if ($response)
        <div class="card">
            <h2>Thank you for your feedback!</h2>
            <p class="mb-0">Your answers help our group evaluate and improve EcoQuest.</p>
        </div>
    @else
        <p class="muted">Rate each statement from 1 (strongly disagree) to 5 (strongly agree).</p>
        @if ($errors->any()) <div class="alert alert-error">{{ $errors->first() }}</div> @endif
        <form method="POST" action="{{ route('survey.submit') }}">
            @csrf
            @php $scale = [1 => 'Strongly disagree', 2 => 'Disagree', 3 => 'Neutral', 4 => 'Agree', 5 => 'Strongly agree']; @endphp
            @foreach ($questions as $key => $text)
                <fieldset class="quiz-q">
                    <legend>{{ $loop->iteration }}. {{ $text }}</legend>
                    <div class="likert">
                        @foreach ($scale as $v => $label)
                            <label><input type="radio" name="{{ $key }}" value="{{ $v }}" required @checked(old($key) == $v)> <strong>{{ $v }}</strong> {{ $label }}</label>
                        @endforeach
                    </div>
                </fieldset>
            @endforeach
            <div class="field">
                <label for="comment">Any other comments or suggestions? (optional)</label>
                <textarea id="comment" name="comment" rows="4">{{ old('comment') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit feedback</button>
        </form>
    @endif
</div>
@endsection
