@extends('layouts.app')
@section('title', 'Save your planet, one choice at a time')

@section('content')
<section class="hero">
    <div class="hero-inner">
        <div class="hero-copy">
            <span class="tag">Free e-learning for university students</span>
            <h1 style="margin-top:16px">Save your planet,<br>one choice at a time.</h1>
            <p>Learn how climate change affects Malaysia, and how your daily choices can help. Complete four levels, earn Eco Points and badges, and watch your planet heal.</p>
            <div class="btn-row">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Continue your quest</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary">Start your quest</a>
                    <a href="{{ route('login') }}" class="btn btn-outline">I already have an account</a>
                @endauth
            </div>
        </div>
        <div class="hero-art">
            <figure class="center mb-0">
                @include('partials.planet', ['stage' => 0, 'id' => 'hero'])
                <figcaption class="small muted">Your planet starts polluted. Every level you complete helps it heal.</figcaption>
            </figure>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <span class="eyebrow">How it works</span>
        <h2>Your quest in three steps</h2>
        <div class="grid grid-3" style="margin-top:20px">
            <div class="card">
                <div class="level-card"><span class="level-num">1</span></div>
                <h3 style="margin-top:12px">Take the pre-test</h3>
                <p class="muted mb-0">10 quick questions to see what you already know.</p>
            </div>
            <div class="card">
                <div class="level-card"><span class="level-num">2</span></div>
                <h3 style="margin-top:12px">Play four levels</h3>
                <p class="muted mb-0">Watch, learn, play an activity and pass a quiz in each level to earn Eco Points.</p>
            </div>
            <div class="card">
                <div class="level-card"><span class="level-num">3</span></div>
                <h3 style="margin-top:12px">Heal your planet</h3>
                <p class="muted mb-0">Finish with the post-test, collect the Eco Hero badge and climb the leaderboard.</p>
            </div>
        </div>
    </div>
</section>

<section class="section" style="background:#fff;border-top:1px solid var(--line);border-bottom:1px solid var(--line)">
    <div class="container">
        <span class="eyebrow">The levels</span>
        <h2>Four levels, four ways to make a difference</h2>
        <div class="grid grid-4" style="margin-top:20px">
            @foreach ($levels as $n => $level)
                <div class="card level-card">
                    <span class="level-num">{{ $n }}</span>
                    <h3 class="mb-0">{{ $level['title'] }}</h3>
                    <p class="muted small mb-0">{{ $level['tagline'] }}</p>
                    <div class="card-foot"><span class="tag tag-green">Activity: {{ $level['activity_name'] }}</span></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid grid-2" style="align-items:center">
            <div>
                <span class="eyebrow">Made for Malaysia</span>
                <h2>Real issues, real agencies</h2>
                <p class="muted">Every level includes a <strong>Malaysia Corner</strong> with local facts and links to official agencies, from checking the Air Pollutant Index with Jabatan Alam Sekitar to recycling with SWCorp and urban farming with Jabatan Pertanian.</p>
                <a href="{{ route('resources') }}" class="btn btn-outline">See Malaysian agencies</a>
            </div>
            <div class="facts">
                <div class="fact"><span class="big">2050</span>Malaysia's target year for net-zero greenhouse gas emissions <span class="cite">(Bernama, 2024)</span></div>
                <div class="fact"><span class="big">RM6.1 bil</span>Estimated losses from the 2021 floods <span class="cite">(DOSM, 2022)</span></div>
                <div class="fact"><span class="big">37.9%</span>Malaysia's national recycling rate in 2024 <span class="cite">(Dzulkifli, 2026)</span></div>
                <div class="fact"><span class="big">~40%</span>Share of landfilled waste that could be recycled <span class="cite">(Dzulkifli, 2026)</span></div>
            </div>
        </div>
    </div>
</section>
@endsection
