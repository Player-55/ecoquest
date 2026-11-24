@extends('layouts.app')
@section('title', 'Create an account')

@section('content')
<div class="container">
    <div class="card form-card">
        <h1 style="font-size:1.8rem">Start your quest</h1>
        <p class="muted">Create a free account to save your progress, Eco Points and badges.</p>
        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf
            <div class="field">
                <label for="name">Full name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="field">
                <label for="password">Password <span class="muted small">(at least 8 characters)</span></label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="field">
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Create account</button>
        </form>
        <p class="small muted center" style="margin-top:16px">Already registered? <a href="{{ route('login') }}">Log in</a></p>
    </div>
</div>
@endsection
