<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EcoQuest') · EcoQuest</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/ecoquest.css') }}?v=1">
</head>
<body>
<header class="site-header">
    <nav class="nav" aria-label="Main">
        <a href="{{ route('home') }}" class="brand">
            @include('partials.logo')
            EcoQuest
        </a>
        <div class="nav-links">
            <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
            <a href="{{ route('dashboard') }}" @class(['active' => request()->routeIs('dashboard', 'levels.*', 'tests.*')])>Levels</a>
            <a href="{{ route('leaderboard') }}" @class(['active' => request()->routeIs('leaderboard')])>Leaderboard</a>
            <a href="{{ route('resources') }}" @class(['active' => request()->routeIs('resources')])>Resources</a>
            <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About Us</a>
            @auth
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.index') }}" @class(['active' => request()->routeIs('admin.*')])>Admin</a>
                @endif
            @endauth
        </div>
        <div class="nav-user">
            @auth
                <span class="points-chip" title="Your Eco Points">
                    @include('partials.leaf', ['size' => 16]) <span id="nav-points">{{ auth()->user()->eco_points }}</span> pts
                </span>
                <span class="small muted">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline-form">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm">Log out</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Log in</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Start your quest</a>
            @endauth
        </div>
    </nav>
</header>

<main id="main">
    @if (session('status'))
        <div class="container"><div class="alert alert-info" role="status">{{ session('status') }}</div></div>
    @endif
    @yield('content')
</main>

<footer class="site-footer">
    <div class="footer-inner">
        <div>
            <h4>EcoQuest</h4>
            <p class="small mb-0">An interactive e-learning website on climate change and sustainable living. A CSC536 Multimedia Instructional Design project.</p>
        </div>
        <div>
            <h4>Learn</h4>
            <ul>
                <li><a href="{{ route('dashboard') }}">Levels</a></li>
                <li><a href="{{ route('leaderboard') }}">Leaderboard</a></li>
                <li><a href="{{ route('challenge') }}">7-Day Green Challenge</a></li>
            </ul>
        </div>
        <div>
            <h4>More</h4>
            <ul>
                <li><a href="{{ route('resources') }}">Malaysian agencies &amp; resources</a></li>
                <li><a href="{{ route('about') }}">About us</a></li>
            </ul>
        </div>
    </div>
</footer>
@stack('scripts')
</body>
</html>
