@extends('layouts.auth')

@section('title', 'Login')

@section('description', 'Log into your ElDewrito Services account.')

@section('content')
<div class="login__block active">
    <div class="login__block__header">
        <i class="zwicon-user-circle"></i>
        {{ __('Welcome back!') }}

        <div class="actions actions--inverse login__block__actions">
            <div class="dropdown">
                <i data-toggle="dropdown" class="zwicon-more-h actions__item"></i>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                    <a class="dropdown-item" href="{{ route('password.request') }}">{{ __('Reset password') }}</a>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="login__block__body">
        @csrf

        <div class="form-group">
            <input type="email" name="email" class="form-control text-center @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" autocomplete="email" required autofocus>
            
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control text-center @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" autocomplete="current-password" required>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                <label class="custom-control-label" for="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('Remember me') }}</label>
            </div>
        </div>

        <button type="submit" class="btn btn-theme btn--icon">
            <i class="zwicon-checkmark" title="{{ __('Login') }}"></i>
        </button>
    </form>
</div>
@endsection
