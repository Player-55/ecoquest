@extends('layouts.app')
@section('title', 'Log in')

@section('content')
<div class="container">
    <div class="card form-card">
        <h1 style="font-size:1.8rem">Welcome back</h1>
        <p class="muted">Log in to continue your quest.</p>
        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:16px">
                <label class="check" style="margin-bottom:0"><input type="checkbox" name="remember"> Remember me</label>
                <a href="{{ route('password.request') }}" class="small">Forgot your password?</a>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Log in</button>
        </form>
        <p class="small muted center" style="margin-top:16px">New here? <a href="{{ route('register') }}">Create an account</a></p>
    </div>
</div>
@endsection
