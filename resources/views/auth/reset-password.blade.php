@extends('layouts.app')
@section('title', 'Set a new password')

@section('content')
<div class="container">
    <div class="card form-card">
        <h1 style="font-size:1.8rem">Set a new password</h1>
        <p class="muted">Choose a new password for your EcoQuest account.</p>
        <form method="POST" action="{{ route('password.update') }}" novalidate>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autocomplete="email">
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="field">
                <label for="password">New password <span class="muted small">(at least 8 characters)</span></label>
                <input id="password" type="password" name="password" required autofocus autocomplete="new-password">
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="field">
                <label for="password_confirmation">Confirm new password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Reset password</button>
        </form>
    </div>
</div>
@endsection
