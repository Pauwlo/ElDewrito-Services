@extends('layouts.auth')

@section('title', 'New password')

@section('content')
<div class="login__block active">
    <div class="login__block__header">
        <i class="zwicon-user-circle"></i>
        {{ __('New password') }}

        <div class="actions actions--inverse login__block__actions">
            <div class="dropdown">
                <i data-toggle="dropdown" class="zwicon-more-h actions__item"></i>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('password.update') }}" class="login__block__body">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group form-group--centered">
            <input type="email" name="email" class="form-control text-center @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" placeholder="{{ __('E-Mail Address') }}" autocomplete="email" required autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group form-group--centered">
            <input type="password" name="password" class="form-control text-center @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" autocomplete="new-password" required>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group form-group--centered">
            <input type="password" name="password_confirmation" class="form-control text-center @error('password') is-invalid @enderror" placeholder="{{ __('Confirm Password') }}" autocomplete="new-password" required>
        </div>

        <button type="submit" class="btn btn-theme btn--icon">
            <i class="zwicon-checkmark" title="{{ __('Reset password') }}"></i>
        </button>
    </form>
</div>
@endsection
