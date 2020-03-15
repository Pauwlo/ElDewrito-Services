@extends('layouts.auth')

@section('title', 'Register')

@section('description', 'Create your account on ElDewrito Services.')

@section('content')
<div class="login__block active">
    <div class="login__block__header">
        <i class="zwicon-user-circle"></i>
        {{ __('Register') }}

        <div class="actions actions--inverse login__block__actions">
            <div class="dropdown">
                <i data-toggle="dropdown" class="zwicon-more-h actions__item"></i>
                
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                    <a class="dropdown-item" href="{{ route('password.request') }}">{{ __('Reset password') }}</a>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="login__block__body">
        @csrf

        <div class="form-group">
            <input type="text" name="name" class="form-control text-center @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ __('Name') }}" autocomplete="name" required autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group form-group--centered">
            <input type="email" name="email" class="form-control text-center @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" autocomplete="email" required>

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
            <i class="zwicon-checkmark" title="{{ __('Register') }}"></i>
        </button>
    </form>
</div>
@endsection
