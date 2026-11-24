@extends('layouts.app')
@section('title', 'Forgot password')

@section('content')
<div class="container">
    <div class="card form-card">
        <h1 style="font-size:1.8rem">Forgot your password?</h1>
        <p class="muted">Enter the email you registered with and we'll send you a link to set a new password.</p>
        <form method="POST" action="{{ route('password.email') }}" novalidate>
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Send reset link</button>
        </form>
        <p class="small muted center" style="margin-top:16px">Remembered it? <a href="{{ route('login') }}">Back to log in</a></p>
    </div>
</div>
@endsection
