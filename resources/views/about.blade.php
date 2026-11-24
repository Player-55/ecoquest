@extends('layouts.app')
@section('title', 'About us')

@section('content')
<div class="container" style="max-width:900px;padding-top:32px;padding-bottom:48px">
    <span class="eyebrow">About</span>
    <h1 style="font-size:2.2rem">About EcoQuest</h1>
    <p>EcoQuest is an interactive multimedia e-learning website developed for the course <strong>CSC536 Multimedia Instructional Design</strong>. It helps university students understand climate change and practise sustainable living, with a focus on Malaysia.</p>

    <h2 style="margin-top:32px">Instructional design</h2>
    <div class="grid grid-2">
        <div class="card"><h3>Gagné's Nine Events of Instruction</h3><p class="muted mb-0">Every level follows the same nine steps, from gaining attention with a video to enhancing retention with key takeaways and the 7-Day Green Challenge.</p></div>
        <div class="card"><h3>ARCS Model of Motivation</h3><p class="muted mb-0"><strong>A</strong>ttention: the polluted planet and real stories. <strong>R</strong>elevance: Malaysian issues and agencies. <strong>C</strong>onfidence: levels unlock step by step. <strong>S</strong>atisfaction: Eco Points, badges and a healing planet.</p></div>
    </div>

    <h2 style="margin-top:32px">Our team</h2>
    <div class="grid grid-4">
        @foreach (['Member 1', 'Member 2', 'Member 3', 'Member 4'] as $i => $m)
            <div class="card center">
                <div class="level-card" style="align-items:center"><span class="level-num">{{ $i + 1 }}</span></div>
                <h3 style="margin-top:10px">[{{ $m }} name]</h3>
                <p class="small muted mb-0">Level {{ $i + 1 }} owner</p>
            </div>
        @endforeach
    </div>
    <p class="small muted" style="margin-top:12px">Edit names in resources/views/about.blade.php.</p>
</div>
@endsection
